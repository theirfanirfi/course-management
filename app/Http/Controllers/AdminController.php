<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\User;
use App\Http\Middleware\adminAuth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //

    public function __construct(){
      $this->middleware('adminAuth');
    }

    public function index()
    {
      $data['courses'] = Course::all();
      return view('admin.AllCourses',$data);
    }

    public function addcourse()
    {
        return view('admin.AddCourse');
    }

    public function submitCourse(Request $req)
    {
        $courseName = $req->input('coursename');
        $stdLimit = $req->input('stdLimit');
        $image = $req->file('courseImage');
        $imagename = $image->getClientOriginalName();
      //Move Uploaded File
      $destinationPath = 'uploads';
      $image_path = $destinationPath ."/".$imagename;
      if($image->move($destinationPath,$imagename))
      {
          $course = new Course();
          $course->courseName = $courseName;
          $course->stdLimit = $stdLimit;
          $course->imagename = $imagename;
          $course->image_path = $image_path;

          if($course->save())
          {
            return redirect('/admin/addcourse')->with('success','Course Added');

          }
          else {

            return redirect('/admin/addcourse')->with('error','Error Occurred in Adding the course. Try agian.');

          }
      }
      else {
        return redirect('/admin/addcourse')->with('error','Error Occurred in uploading the image. Try again');

      }

    }

    public function allCourses()
    {
      $data['courses'] = Course::all();
      return view('admin.AllCourses',$data);
    }

    public function editCourse($id)
    {
      $data['course'] = Course::find($id);
      return view('Admin.EditCourse',$data);
    }

    public function submitEditCourse(Request $req)
    {
      $course = Course::find($req->input('course_id'));
        $courseName = $req->input('coursename');
        $stdLimit = $req->input('stdLimit');
        $course_id = $req->input('course_id');


      if($req->hasFile('courseImage'))
      {
        $image = $req->file('courseImage');
        $imagename = $image->getClientOriginalName();
      //Move Uploaded File
      $destinationPath = 'uploads';
      $image_path = $destinationPath ."/".$imagename;
      $r = public_path().'/uploads/'.$course->imagename;
      unlink($r);
      if($image->move($destinationPath,$imagename))
      {
          $course->courseName = $courseName;
          $course->stdLimit = $stdLimit;
          $course->imagename = $imagename;
          $course->image_path = $image_path;

          if($course->save())
          {
            return redirect("/admin/editCourse/{$course_id}")->with('success','Course Updated');

          }
          else {

            return redirect("/admin/editCourse/{$course_id}")->with('error','Error Occurred in Updating the course. Try agian.');

          }
      }
      else {
        return redirect("/admin/editCourse/{$course_id}")->with('error','Error Occurred in updating the image. Try again');

      }


      }
      else
      {

        $course->courseName = $courseName;
        $course->stdLimit = $stdLimit;
        if($course->save())
        {
          return redirect("/admin/editCourse/{$course_id}")->with('success','Course Updated');


        }
        else {
          return redirect("/admin/editCourse/{$course_id}")->with('error','Error occurred in updating the course. Try agian.');

        }
    }
  }

  public function deletecourse($id)
  {
    $course = Course::find($id);
    if(!empty($course)){
    if($course->delete())
    {
      echo "1";
    }
    else {
      echo "0";
    }
  }else {
    echo "0";
  }
  }

  public function studentList()
  {
    $data['users'] = User::where('role','=',0)->get();
    return view('Admin.studentList',$data);
  }

  public function courseStudentList($id)
  {
    $data['ens'] = Enrollment::where('c_id','=',$id)->get();
    $data['course'] = Course::find($id);
    $data['courses'] = Course::all();
    return view('Admin.courseStudentList',$data);

  }

  public function deleteStudent($id)
  {
    $user = User::find($id);
    $en = Enrollment::where('user_id','=',$id)->get()->first();
    if(!empty($user)){
    if($user->delete())
    {
      $en->delete();
      echo "1";
    }
    else {
      echo "0";
    }
  }else {
    echo "0";
  }
  }

  public function waitingStudentList()
  {
    $data['waitings'] = Enrollment::where('is_awaiting','=',1)->get();
    return view('Admin.waitingStudentList',$data);
  }

  public function promoteStudent($cid,$uid)
  {
    $e = Enrollment::where('user_id','=',$uid)->first();
    $e->c_id = $cid;
    $course = Course::find($cid);
    $ec = Enrollment::where('c_id','=',$cid)->get()->count();
    if($ec < $course->stdLimit)
    {
      $e->is_awaiting = 0;
    }
    else {
      $e->is_awaiting = 1;
    }
    if($e->save())
    {
      echo "1";
    }
    else {
      echo "0";
    }
  }

  public function exportXL($id)
  {
    $ss= Enrollment::where('c_id','=',$id);
    if($ss->count() > 0){
    $sIds = $ss->get();
    $course = Course::find($id);
    $students = array();
    foreach($sIds as $idd){
      $user = User::find($idd->user_id);
      $students[] = ['Student Name' => $user->name, 'Email'=> $user->email, 'Course'=>$course->courseName, 'Course Enrollment Date'=>$idd->created_at, 'Registration date'=>$user->created_at];
    }

    Excel::create($course->courseName." Students List", function($excel) use ($students) {

    $excel->sheet('Sheetname', function($sheet) use ($students) {

        $sheet->fromArray($students
        );

    });

})->export('xls');


}else {
  return redirect()->back()->with('error','There are no Students in the course to Export.');
}
}


public function exportPDF($id)
{
  $ss= Enrollment::where('c_id','=',$id);
    $course = Course::find($id);
  if($ss->count() > 0){
  $sIds = $ss->get();
  $data['students'] = $sIds;
  $data['course'] = $course;
  return view('Admin.pdfprint',$data);
}
else {
  return redirect()->back()->with('error','There are no Students in the course to Export.');
}
}
}
