        @include('admin.partials.header');
        @include('admin.partials.sidenav');
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{ $totalApparel }}</h4>
                                <h5>Total Products</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="tag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{ $totalRented }}</h4>
                                <h5>Rented Out Products</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="minus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>3</h4>
                                <h5>Overdue</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="alert-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{-- {{$totalCategory}} --}}</h4>
                                <h5>Staffs</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{ $totalCategory }}</h4>
                                <h5>Categories</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="layers"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{ $totalSizes }}</h4>
                                <h5>Sizes</h5>
                            </div>
                            <div class="dash-imgs">
                                {{-- <i title="ti-ruler-alt"></i> --}}
                                <i class="ti-ruler-alt" title="ti-ruler-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #bd9a62">
                            <div class="dash-counts">
                                <h4>{{ $totalColors }}</h4>
                                <h5>Colors</h5>
                            </div>
                            <div class="dash-imgs">
                                <i class="ti-palette" title="ti-palette"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="s-line" class="chart-set"></div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

        <script src="{{ asset('assets/js/feather.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

        <script src="{{ asset('assets/js/script.js') }}"></script>
        </body>

        </html>
