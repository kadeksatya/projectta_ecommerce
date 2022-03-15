<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('link_style')
    @include('layouts.link_style')
</head>

<body>
    <div class="app">
        <div class="layout">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error" data-message="{{$error}}"></div>
            @endforeach
            @endif

            @if(session('success'))
            <span class="success" data-message="{{session('success')}}"></span>
            @endif
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="{{route('home')}}" style="padding-top:21px">
                        <h5 class="logo-full">CV. Cahaya Cinta Kasih</h5>
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.html">
                        <img src="assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="assets/images/logo/logo-fold-white.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <!--
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>-->
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <i class="anticon anticon-user" style="color:#53535f"></i>
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <i class="anticon anticon-user" style="color:#53535f"></i>
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold">{{auth()->user()->name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10 logout-btn">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" id="form-logout">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- Header END -->

            @include('layouts.nav')

            <!-- Page Container START -->
            <div class="page-container">


                <!-- Content Wrapper START -->
                <div class="main-content">
                    @yield('content')
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © 2021</p>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>


    @include('layouts.link_js')
    
    <script>
        $(document).ready(function () {
            $('.datepicker-input').datepicker({
                format: 'yyyy-m-d'
            });
            
            $('.logout-btn').click(function(){
                $("#form-logout").submit();
            })
 
            // Drofify

        // Delete Localstorage
        window.onunload = function () {
            localStorage.clear();
        }

        $('.dropify').dropify()

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }

        $('.error').show(function(){
            var message = $(this).data('message')
            Swal.fire(
            'Perhatian',
            message,
            'error'
            )
        })

        $('.success').show(function(){
            var message = $(this).data('message')
            toastr.success(message, 'Perhatian')
        })

          $('.delete').click(function(){
            var label = $(this).data('label');
            var url = $(this).data('url');
            Swal.fire({
            title: 'Perhatian',
            text: "Apakah yakin menghapus data "+label+" ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
          }).then((result) => {
            if (result.isConfirmed) {
              var id = $(this).data("id");
              var token = $("meta[name='csrf-token']").attr("content");
                  $.ajax(
                    {
                        url: url,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data){
                          Swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                          )
                          window.location.reload().time(3)
                        }
                    });
            }
          })
          })

          $('#data-table').DataTable();

        });
      </script>

@stack('script')

</body>

</html>
