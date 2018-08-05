<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login',function(){
  return view('login');
});

Route::post('/customlogin','LoginController@login');

Auth::routes();

Route::group(['prefix'=>'/home','middleware'=>'auth'],function(){
    Route::get('/','HomeController@index');
    Route::post('/enrollment','HomeController@enrollment');
    Route::get('/waitinglist','HomeController@waitingList');
    Route::get('/profile','HomeController@profile');
    Route::post('/submitProfile','HomeController@submitProfile');
    Route::get('/cancelEnrolment/{id}/{cid}','HomeController@cancelEnrolment');
    Route::get('/class','HomeController@enrolledClass');
    Route::get('/notify','HomeController@notify');
    Route::get('/notifications','HomeController@notifications');
    Route::get('/deleteNotification/{id}','HomeController@deleteNotification');

});



Route::group(['prefix'=> 'admin', 'middleware' => 'adminAuth'],function(){
   Route::get('/','AdminController@index');
    Route::get('/addcourse','AdminController@addcourse');
    Route::post('/submitCourse','AdminController@submitCourse');
    Route::get('/courses','AdminController@allCourses');
    Route::get('/editCourse/{id}','AdminController@editCourse');
    Route::post('/submitEditCourse','AdminController@submitEditCourse');
    Route::get('/deletecourse/{id}','AdminController@deletecourse');
    Route::get('/studentList','AdminController@studentList');
    Route::get('/deleteStudent/{id}', 'AdminController@deleteStudent');
    Route::get('/waitingStudents','AdminController@waitingStudentList');
    Route::get('/courseStudentList/{id}','AdminController@courseStudentList');
    Route::get('/promoteStudent/{cid}/{uid}','AdminController@promoteStudent');
    Route::get('/exportPDF/{id}','AdminController@exportPDF');
    Route::get('/exportXL/{id}','AdminController@exportXL');

});
