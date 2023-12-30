@include('admin.partials.header');
@include('admin.partials.sidenav');
<style>
    #see:hover {
        transform: scale(1.1);
    }
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-sm-12 tabs_wrapper">
                <ul class=" tabs owl-carousel owl-theme owl-product  border-0 " style="margin-bottom: 2rem">
                    <li class="active" id="All">
                        <a class="product-details">
                            <h6>All Rentor</h6>
                        </a>
                    </li>
                    <li id="Renting">
                        <div class="product-details ">
                            <h6>Renting</h6>
                        </div>
                    </li>
                    <li id="Overdue">
                        <div class="product-details ">
                            <h6>Overdue</h6>
                        </div>
                    </li>
                    <li id="Returned">
                        <div class="product-details ">
                            <h6>Returned</h6>
                        </div>
                    </li>
                </ul>
                <div class="tabs_container">
                    <div class="tab_content active" data-tab="All">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-path">
                                            <!-- <a class="btn btn-filter" id="filter_search"> -->
                                            <img src="assets/img/icons/filter.svg" alt="img">
                                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                            </a>
                                        </div>
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>Rentor Name</th>
                                                <th>Balance</th>
                                                <th>Rent Type</th>
                                                <th>Status</th>
                                                <th>More Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rentors as $rentor)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($rentor->return_date)->format('M d, Y') }}
                                                    </td>
                                                    <td>{{ $rentor->last_name }} {{ $rentor->first_name }}</td>
                                                    <td>&#8369; {{ $rentor->balance }}</td>
                                                    <td>{{ $rentor->rent_type }}</td>
                                                    <td>
                                                        @if ($rentor->status === 'Renting')
                                                            <span class="badges bg-lightyellow">Renting</span>
                                                        @elseif ($rentor->status === 'Overdue')
                                                            <span class="badges bg-lightred">Overdue</span>
                                                        @else
                                                            <span class="badges bg-lightgreen">Returned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a class="me-3"
                                                                href="{{ url('/rentor/rentorDetails/' . $rentor->id) }}">
                                                                <img id="see" src="assets/img/icons/eye.svg"
                                                                    alt="img">
                                                            </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <style>
                                    #see:hover {
                                        transform: scale(1.1);
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="tab_content" data-tab="Renting">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-path">
                                            <!-- <a class="btn btn-filter" id="filter_search"> -->
                                            <img src="assets/img/icons/filter.svg" alt="img">
                                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                            </a>
                                        </div>
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>Rentor Name</th>
                                                <th>Balance</th>
                                                <th>Rent Type</th>
                                                <th>Status</th>
                                                <th>More Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($renting as $rentor)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($rentor->return_date)->format('M d, Y') }}
                                                    </td>
                                                    <td>{{ $rentor->last_name }} {{ $rentor->first_name }}</td>
                                                    <td>&#8369; {{ $rentor->balance }}</td>
                                                    <td>{{ $rentor->rent_type }}</td>
                                                    <td>
                                                        @if ($rentor->status === 'Renting')
                                                            <span class="badges bg-lightyellow">Renting</span>
                                                        @elseif ($rentor->status === 'Overdue')
                                                            <span class="badges bg-lightred">Overdue</span>
                                                        @else
                                                            <span class="badges bg-lightgreen">Returned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a class="me-3"
                                                                href="{{ url('/rentor/rentorDetails/' . $rentor->id) }}">
                                                                <img id="see" src="assets/img/icons/eye.svg"
                                                                    alt="img">
                                                            </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <style>
                                    #see:hover {
                                        transform: scale(1.1);
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="tab_content" data-tab="Overdue">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-path">
                                            <!-- <a class="btn btn-filter" id="filter_search"> -->
                                            <img src="assets/img/icons/filter.svg" alt="img">
                                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                            </a>
                                        </div>
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>Rentor Name</th>
                                                <th>Balance</th>
                                                <th>Rent Type</th>
                                                <th>Status</th>
                                                <th>More Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($overdue as $rentor)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($rentor->return_date)->format('M d, Y') }}
                                                    </td>
                                                    <td>{{ $rentor->last_name }} {{ $rentor->first_name }}</td>
                                                    <td>&#8369; {{ $rentor->balance }}</td>
                                                    <td>{{ $rentor->rent_type }}</td>
                                                    <td>
                                                        @if ($rentor->status === 'Renting')
                                                            <span class="badges bg-lightyellow">Renting</span>
                                                        @elseif ($rentor->status === 'Overdue')
                                                            <span class="badges bg-lightred">Overdue</span>
                                                        @else
                                                            <span class="badges bg-lightgreen">Returned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a class="me-3"
                                                                href="{{ url('/rentor/rentorDetails/' . $rentor->id) }}">
                                                                <img id="see" src="assets/img/icons/eye.svg"
                                                                    alt="img">
                                                            </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <style>
                                    #see:hover {
                                        transform: scale(1.1);
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="tab_content" data-tab="Returned">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-path">
                                            <!-- <a class="btn btn-filter" id="filter_search"> -->
                                            <img src="assets/img/icons/filter.svg" alt="img">
                                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                            </a>
                                        </div>
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Return Date</th>
                                                <th>Rentor Name</th>
                                                <th>Balance</th>
                                                <th>Rent Type</th>
                                                <th>Status</th>
                                                <th>More Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($returned as $rentor)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($rentor->return_date)->format('M d, Y') }}
                                                    </td>
                                                    <td>{{ $rentor->last_name }} {{ $rentor->first_name }}</td>
                                                    <td>&#8369; {{ $rentor->balance }}</td>
                                                    <td>{{ $rentor->rent_type }}</td>
                                                    <td>
                                                        @if ($rentor->status === 'Renting')
                                                            <span class="badges bg-lightyellow">Renting</span>
                                                        @elseif ($rentor->status === 'Overdue')
                                                            <span class="badges bg-lightred">Overdue</span>
                                                        @else
                                                            <span class="badges bg-lightgreen">Returned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a class="me-3"
                                                                href="{{ url('/rentor/rentorDetails/' . $rentor->id) }}">
                                                                <img id="see" src="assets/img/icons/eye.svg"
                                                                    alt="img">
                                                            </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <style>
                                    #see:hover {
                                        transform: scale(1.1);
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
@livewireScripts
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
