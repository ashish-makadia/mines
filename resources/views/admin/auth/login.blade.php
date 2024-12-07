<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mine | Log in</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css?v=3.2.0') }}">

  <!--Tost meassage link -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>ACME</b>Mine</a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('loginpost') }}" method="post" id="loginForm" autocomplete="off">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-6 col-6  mb-3"> --}}
            <div class="form-group">
                <label for="mine_id"><span class="text-red">*</span>Mines</label>
                <select name="mine_id" class="form-control select2 a3" style="z-index:10">
                    <option value="">Select Mine</option>
                    @foreach($mines as $mine)
                        <option value="{{$mine->id}}">{{$mine->mine_name}}</option>
                    @endforeach
                    </select>
            </div>
        {{-- </div> --}}
          <!-- <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>

          </div> -->
          <div class="social-auth-links text-center mb-3">
            <button type="submit" class="btn btn-block btn-primary">Sign In</button>
          </div>
        </form>


        <!-- <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
      </div>
    </div>
  </div>


  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- jquery-validation -->
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

  <script src="{{ asset('assets/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

  <!-- ----toster message---- -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
    $(function() {
      $.validator.setDefaults({
        submitHandler: function() {
          return true;
          // alert( "Form successful submitted!" );
        }
      });
      $('#loginForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          mine_id:{
            required: true,
          },
          password: {
            required: true,
            minlength: 5
          },
          terms: {
            required: true
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          mine_id:{
            required: "Please select mine",
          }
        //   terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
          element.closest('.form-control').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

  <script>
    @if(Session::has('message'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('error'))
    toastr.options = {
      "closeButton": true,
      "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif
  </script>

</body>

</html>
