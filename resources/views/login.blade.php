
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>designS2dio</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/alertify.default.css') }}">
    <script src="{{ URL::asset('js/alertify.min.js') }}"></script>


      <link rel="stylesheet" href="{{URL::asset('css/style.css') }}">


</head>

<body style="background-image: url('{{URL::asset('img/bg.jpg')}}'); background-repeat:no-repeat; background-size: 100% 140%; ">
  <div style="height:900px;">
  <div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">
          <div class="row">
          <img src="{{URL::asset('img/logo.png')}}" style="width:100%;height:140px;" />
        </div> <div class="row">
          <h1>Sign Up</h1>
        </div>


          <form method="POST" action="{{ route('register') }}" id="form">
            {!! csrf_field() !!}


            <div class="field-wrap">
              <label>
                Full Name <span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" id="name"/>
              @if ($errors->has('name'))
                  <span class="invalid-feedback">
                      <strong style="color:white;">{{ $errors->first('name') }}</strong>
                  </span>
              @endif
            </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input id="email" type="email"required autocomplete="off" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"/>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong style="color:white;">{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input id="password" type="password"required autocomplete="off" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"/>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong style="color:white;">{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>

          <div class="field-wrap">
            <label>
              Confirm Password<span class="req">*</span>
            </label>
            <input id="password-confirm" type="password"required autocomplete="off" name="password_confirmation"/>
          </div>

          <button type="submit" class="button button-block"/>Register</button>

          </form>

        </div>

        <div id="login">
          <div class="row">
          <img src="{{URL::asset('img/logo.png')}}" style="width:100%;height:140px;" />
        </div> <div class="row">
          <h1>Login IN</h1>
        </div>

          <form method="POST" action="{{ URL::to('/customlogin') }}">
            @csrf

            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="emaill"/>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong style="color:White;">{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password"/>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong style="color:White;">{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>



          <p class="forgot"><a href="{{ route('password.request') }}">Forgot Password?</a></p>

          <button class="button button-block"/>Log In</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
</div>

<footer class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="text-align:center;background-color:white;opacity:0.7;">
      <h4 style="margin-top:22px;margin-bottom:12px;">Copyright designS2dio.com Designed by designS2dio.com</h4>
    </div>
    <div class="col-md-2"></div>
  </div>
</footer>
  <script src="http://code.jquery.com/jquery-1.11.1.js"></script>

    <script  src="{{URL::asset('js/indexx.js') }}"></script>

<script>

$('#form').submit(function(e){
  var email = $('#email').val();
  var pattern = "(.+@+[A-Za-z0-9._-]+\\.designS2dio.com$)|(.+@designS2dio.com$)";
  if(!email.match(pattern)){
  e.preventDefault();
  alertify.error('Unsupported email domain. Use @designS2dio.com email domain for registeration.');
}
});

</script>

@if(Session('error'))
<script>
alertify.error('{{Session('error')}}');
</script>
@endif
</body>

</html>
