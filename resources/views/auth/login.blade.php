<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png')}} ">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    <style>
        .imgs{
            position: absolute;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
        }
    </style>

</head>

<body>
    <div class="app">
        @if (session()->has('error'))
        <div class="error" data-message="{{session('error')}}" role="alert">
        </div>
        @endif
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
            style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <center><img src="{{asset('image/logo.png')}}" alt="" srcset="" class="img-thumbnail mb-3" width="50%"></center>
                                    <div class="align-items-center justify-content-between m-b-30">
                                        <center><h4>BLOOMINGFIELDS BALI</h4></center>
                                    </div>
                                    @if ($message = Session::get('gagal'))
                                    <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    </div>
                                    @endif
                                    <form method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="username">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    placeholder="Username" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">

                                                </span>
                                                <button class="btn btn-primary" type="submit">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2021</span>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ asset('assets/js/app.min.js')}} "></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.error').show(function () {
            var message = $(this).data('message')
            Swal.fire(
                'Perhatian',
                message,
                'error'
            )
        })
    </script>

</body>

</html>
