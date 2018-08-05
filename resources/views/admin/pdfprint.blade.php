<html>
<head>
<title>Print/Export Student List</title>
<!-- END PLUGINS CSS -->

<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
<style>
@media print {
    a, p {
        display:none;
    }
 }

 @media screen and projection {
    a {
        display:none;
    }
  }
</style>

</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6" style="text-align:center;">
      <div class="row">
      <img src="{{URL::asset('img/logo.png')}}" style="width:100%;height:150px;" />
    </div>
    <div class="row">
      <h2>Course: {{$course->courseName}} Students List</h2>
    </div>
    </div>
<div class="col-md-4">
<button class="btn btn-primary"> Print/PDF</button>
</div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
  <table class="table">
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Email</th>
        <th>Course Name</th>
        <th>Enrollment Date</th>
        <th>Registered on </th>
      </tr>
    </thead>


    <tbody>
    @if(!empty($students))
      @foreach($students as $s)
        <tr>
          <td>{{$s->getStudent()->name}}</td>
          <td>{{$s->getStudent()->email}}</td>
          <td>{{$s->getCourse()->courseName}}</td>
          <td>{{$s->created_at}}</td>
          <td>{{$s->getStudent()->created_at}}</td>
        </tr>
      @endforeach
    @endif


    </tbody>
  </table>
</div>
</div>
</div>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script>
$('button').click(function(){
  $(this).hide();
  window.print();
});
</script>
</body>
</html>
