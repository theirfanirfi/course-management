function deleteCourse(link)
{
  var URL = $(link).attr('data-url');
  var idd = $(link).attr('c_value');

  $.get(URL, function(data){
      if(data > 0)
      {
        alertify.success('Course Deleted');
        $('#'+idd).remove();

    }
    else {
    alertify.error('Error Occurred in deleting the Course. Try again.');
    }
  });

  return false;
}

function deleteStudent(link)
{
  var URL = $(link).attr('data-url');
  var idd = $(link).attr('u_value');

  $.get(URL, function(data){
      if(data > 0)
      {
        alertify.success('Student Deleted');
        $('#'+idd).remove();

    }
    else {
    alertify.error('Error Occurred in deleting the Student. Try again.');
    }
  });

  return false;
}

function cancelEnrolment(btn)
{
  var url = $(btn).attr('url');
  var cid = $(btn).attr('course_id');
  $.get(url,function(data){
    if(data > 0)
    {
      alertify.success('Enrollment cancelled.');
      $('#'+cid).remove();
    }
    else {
      alertify.error('Error occurred in canceling the enrollment. try again later');
    }
  });
}


function cancelEnrolmentExit(btn)
{
  var url = $(btn).attr('url');
  var url2 = $(btn).attr('url2');
  $.get(url,function(data){
    if(data > 0)
    {
      alertify.success('Enrollment cancelled.');
      setTimeout(proceedToUrl(url2),2000);
    }
    else {
      alertify.error('Error occurred in canceling the enrollment. try again later');
    }
  });
}

function proceedToUrl(URL)
{
  window.location.href=URL;
}

setInterval(checkNotification,2000);

function checkNotification()
{
var url =  $('#notificationIcon').attr('url');
$.get(url,function(data){
if(data > 0)
{
  $('#notificationIcon').text("1");
}
});
}



function deleteNotification(link)
{
  var URL = $(link).attr('data-url');
  var idd = $(link).attr('n_value');

  $.get(URL, function(data){
      if(data > 0)
      {
        alertify.success('Notification Deleted');
        $('#'+idd).remove();

    }
    else {
    alertify.error('Error Occurred in deleting the Notification. Try again.');
    }
  });

  return false;
}
