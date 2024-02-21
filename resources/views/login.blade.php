
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/third-party/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/assets/css/components.css')}}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header"><h4>Login</h4></div>
                                <div class="card-body">
                                    @if(session('error')) 
                                        <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form method="POST" action="{!! route('login') !!}" class="needs-validation" novalidate="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username" placeholder="Username" tabindex="1" required autofocus>
                                            <div class="invalid-feedback">
                                                Please fill in your Username
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                        Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> Development By <a href="">Byu</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('assets/third-party/jquery.js')}}"></script>
    <script src="{{asset('assets/third-party/popper.js')}}"></script>
    <script src="{{asset('assets/third-party/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/third-party/nicescroll.js')}}"></script>
    <script src="{{asset('assets/third-party/moment.js')}}"></script>
    <script src="{{asset('assets/assets/js/stisla.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/assets/js/custom.js')}}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function () {
                $('#alert').slideUp();
            }, 4000);
        });
    </script>
</body>
</html>
