<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Larosa</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/picture/LarosaSmall.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/themify/themify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/twitter-bootstrap-wizard/form-wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}" />

    {{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}

    {{-- for crazy --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script> --}}


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">


    {{-- for crazy --}}

    @livewireStyles
</head>

<body>
    {{-- <div id="global-loader">
        <div class="whirly-loader"></div>
    </div> --}}
    @if (session('success'))
        <script>
            setTimeout(function() {
                toastr.success("{{ Session::get('success') }}", "Action Succesfull!")
            }, 100);
        </script>
    @endif

    @if (session('error'))
        <script>
            setTimeout(function() {
                toastr.error("{{ Session::get('error') }}", "Action Not Permitted!")
            }, 100);
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                setTimeout(function() {
                    toastr.error("{{ $error }}", "Action Error!")

                }, 100);
            </script>
        @endforeach
    @endif


    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ url('home') }}" class="logo">
                    <img src="{{ asset('assets/picture/Larosa.jpg') }}" alt="" />
                </a>
                <a href="{{ url('home') }}" class="logo-small">
                    <img src="{{ asset('assets/picture/LarosaSmall.jpg') }}" alt="" />
                </a>
                <a id="toggle_btn" href="{{ asset('javascript:void(0);') }}"> </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset('assets/img/profiles/avator1.jpg') }}"
                                alt="" />
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="{{ asset('assets/img/profiles/avator1.jpg') }}"
                                        alt="" />
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <h5>{{ Auth::user()->usertype }}</h5>
                                </div>
                            </div>
                            <hr class="m-0" />


                            <x-responsive-nav-link :href="route('profile.edit')">
                                <p class="dropdown-item"><i class="me-2"
                                        data-feather="user"></i>{{ __('My Profile') }}</p>
                            </x-responsive-nav-link>

                            <hr class="m-0" />
                            <div class="dropdown-item logout pb-0">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <p class="dropdown-item logout pb-0"><img
                                                src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2"
                                                alt="img" /> {{ __('LogOut') }}</p>
                                    </x-responsive-nav-link>
                                </form>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" href="profile.php">My Profile</a> --}}

                    <x-responsive-nav-link :href="route('profile.edit')" class="dropdown-item">
                        <p> {{ __('My Profile') }} </p>
                    </x-responsive-nav-link>




                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="dropdown-item">
                            <p>{{ __('LogOut') }}</p>
                        </x-responsive-nav-link>
                    </form>

                </div>
            </div>
        </div>
