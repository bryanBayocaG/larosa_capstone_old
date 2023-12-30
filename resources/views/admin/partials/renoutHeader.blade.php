<div class="header">

    <div class="header-left border-0 ">
        <a href="{{ url('home') }}" class="logo">
            <img src="{{ asset('assets/picture/Larosa.jpg') }}" alt="">
        </a>
        <a href="{{ url('home') }}" class="logo-small">
            <img src="{{ asset('assets/picture/LarosaSmall.jpg') }}" alt="">
        </a>
    </div>


    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('assets/img/profiles/avator1.jpg') }}" alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset('assets/img/profiles/avator1.jpg') }}" alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name }}</h6>
                            <h5>{{ Auth::user()->usertype }}</h5>
                        </div>
                    </div>
                    <hr class="m-0">

                    <x-responsive-nav-link :href="route('profile.edit')">
                        <p class="dropdown-item"><i class="me-2" data-feather="user"></i>{{ __('My Profile') }}</p>
                    </x-responsive-nav-link>

                    <hr class="m-0">
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
