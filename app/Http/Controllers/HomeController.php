<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['user'] = Auth::user();
      $data['courses'] = Course::all();
      $user_id = Auth::user()->id;
      $enrolment = Enrollment::where('user_id','=',$user_id)->get();
      if($enrolment->count() > 0){

        $en = $enrolment->first();
      Session()->put('isWaiting',$en->is_awaiting);
      Session()->put('enrolled',"1");
      Session()->put('course_id',$en->c_id);
    }
    else {
      Session()->put('new',1);
      Session()->put('enrolled',0);
    }

        return view('mainlayout',$data);
    }

    public function enrollment(Request $req)
    {
      $e = new Enrollment();
      $sid = $req->input('student_id');
      $user = User::find($sid);
      if($user->isProfile > 0){
      $enfind = Enrollment::where('user_id','=',$sid)->get()->count();
      $courseStudentCount = Enrollment::where('c_id','=',$req->input('course_id'))->get()->count();

            $cid = $req->input('course_id');
            $ce = Course::find($cid);

      if($enfind == 0){

      $count = Enrollment::where('c_id','=',$cid)->get()->count();

      $isAwaiting = $ce->stdLimit > $count ? 0 : 1;

      $e->user_id = $sid;
      $e->c_id = $cid;
      $e->is_awaiting = $isAwaiting;

      if($e->save())
      {
        Session()->put('isWaiting',$isAwaiting);
        Session()->put('enrolled',"1");
        Session()->put('course_id',$cid);
            if($courseStudentCount < $ce->stdLimit){
        return redirect('/home/class')->with('success','Successfully enrolled.');
      }else {
        return redirect('home/waitinglist')->with('error','Class is full. You are now in waiting list.');
      }
      }
      else {
        return redirect('/home/')->with('error','Error Occurred in enrolling. Try again later.');

      }

    }
    else {
      return redirect('/home/')->with('error','You are already enrolled in one course');

    }
  }else {
    return redirect()->back()->with('error','You will be able to enroll after filling your profile.');
  }

    }

    public function waitingList()
    {
      $e = Enrollment::where('is_awaiting','=','1')->where('c_id','=',Session('course_id'))->get();
      $data['waitingCount'] = $e->count();
      $data['ens']= $e;
      $data['position'] = "";
      $j = 1;
      foreach($e as $i)
      {
        if($i->user_id == Auth::user()->id)
        {
          $data['position'] = $j;
          $data['user_id'] = $i->user_id;
          break;
        }

        $j++;
      }
      $c = Course::find(Session('course_id'));
      $data['course_name'] = $c->courseName;
      $data['course_id'] = $c->c_id;
      return view('waitingList',$data);
    }

    public function profile()
    {
      $data['user'] = User::find(Auth::user()->id);
      return view('profile',$data);
    }

    public function submitProfile(Request $req)
    {
      $name = $req->input('name');
      $age = $req->input('age');
      $level = $req->input('level');
      $user = User::find(Auth::user()->id);
      $user->name = $name;
      $user->age = $age;
      $user->year_level = $level;
      $user->isProfile = 1;
      if($user->save())
      {
        return redirect('home/profile')->with('success', 'Profile Updated');
      }
      else {
        return redirect('home/profile')->with('error', 'Error Occurred in updating the Profile. Try again.');

      }
    }

    public function cancelEnrolment($id,$cid)
    {
      $e = Enrollment::where('user_id','=',$id)->where('c_id','=',$cid)->get()->first();
      if($e->delete())
      {
        Session()->put('isWaiting',0);
        Session()->put('enrolled',0);
        echo "1";
      }
      else {
        echo "0";
      }
    }

    public function enrolledClass()
    {
      $user_id = Auth::user()->id;
      $en = Enrollment::where('user_id','=',$user_id)->get()->first();
      $course = Course::find($en->c_id);
      $data['course'] = $course;
      $data['user_id'] = $user_id;
      return view('activeclass',$data);
    }

    public function notify()
    {
      $user_id = Auth::user()->id;
      $en = Enrollment::where('user_id','=',$user_id)->where('is_awaiting','=',1);
      if($en->count() > 0)
      {
        $ee = $en->first();
        $course_id = $ee->c_id;
        $course = Course::find($course_id);
        $enrol = Enrollment::where('c_id','=',$course_id)->where('is_awaiting','=',0)->get()->count();
        if($course->stdLimit > $enrol)
        {
          $ee->is_awaiting = 0;
          if($ee->save())
          {
            $n = new Notification();
            $n->user_id = $user_id;
            $n->c_id = $course_id;
            $n->description = "You are now enrolled in the course: ".$course->courseName." - ". "You are not in waiting list any more.";
            if($n->save())
            {
              echo "1";
            }
            else {
              echo "0";
            }

          }
          else {
            echo "0";
          }
        }
        else {
          echo "0";
        }
      }
      else {
        echo "0";
      }

    }

    public function notifications()
    {
      $user_id = Auth::user()->id;
      $n = Notification::where('user_id','=',$user_id)->get();
      $data['nos'] = $n;
      return view('notify',$data);

    }

    public function deleteNotification($id)
    {
      $n = Notification::find($id);
      if($n->delete())
      {
        echo "1";
      }
      else {
        echo "0";
      }
    }


}
