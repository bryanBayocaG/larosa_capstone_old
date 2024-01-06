<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li
                    class="{{ in_array(request()->segment(1), ['home', 'colorPage', 'sizePage', 'itemCategPage', 'setCategPage', 'rentor', 'reportSingleItem']) ? 'active' : '' }}">
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>Dashboard</span>
                    </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }}"
                            alt="img" /><span>
                            Inventory</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        {{-- <li>
                            <a class="{{ request()->segment(2) == 'attributes' ? 'active' : '' }}"
                                href="{{ route('attributes.page') }}">Manage Attributes</a>
                        </li> --}}
                        <li>
                            <a class="{{ request()->segment(2) == 'items' ? 'active' : '' }}"
                                href="{{ route('items.page') }}">Manage Single Product</a>
                        </li>
                        <li>
                            <a class="{{ in_array(request()->segment(2), ['set', 'productset']) ? 'active' : '' }}"
                                href="{{ route('productset.page') }}">Manage Set Product</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('renting.page') }}"><i data-feather="log-out"></i><span> Rent-out</span>
                    </a>
                </li>

                {{-- <li>
                    <a class="{{ request()->segment(1) == 'rentor' ? 'active' : '' }}"
                        href="{{ route('rentor.page') }}"><i data-feather="users"></i><span> Rentors</span>
                    </a>
                </li> --}}


                {{-- @if (Auth::user()->usertype == 'Admin')
                    <li class="submenu">
                        <a href="javascript:void(0);"><i data-feather="user-check"></i><span> Users</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ request()->segment(1) == 'newuser' ? 'active' : '' }}"
                                    href="{{ route('newuser.page') }}">New User </a></li>
                            <li><a href="">Users List</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="" href=""><i data-feather="users"></i><span> Check Logs</span>
                        </a>
                    </li>
                @else
                    <h4>Welcome Staff</h4>
                @endif --}}
            </ul>
        </div>
    </div>
</div>
