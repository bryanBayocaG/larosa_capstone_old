        @include('admin.partials.header');
        @include('admin.partials.sidenav');
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">

                        <div class="dash-count das2" style="background-color: #977640">
                            <div class="dash-counts">
                                <h4>{{ $totalCategory }}</h4>
                                <h5>Set Categories</h5>
                                <a class="btn btn-primary" href="{{ route('setCategPage') }}">
                                    View Info
                                </a>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="layers"></i>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #977640">
                            <div class="dash-counts">
                                <h4>{{ $totalCategory }}</h4>
                                <h5>Single Item Categories</h5>
                                <a class="btn btn-primary" href="{{ route('itemCategPage') }}">
                                    View Info
                                </a>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="layers"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #977640">
                            <div class="dash-counts">
                                <h4>{{ $totalSizes }}</h4>
                                <h5>Sizes</h5>
                                <a class="btn btn-primary" href="{{ route('sizePage') }}">
                                    View Info
                                </a>
                            </div>
                            <div class="dash-imgs">
                                {{-- <i title="ti-ruler-alt"></i> --}}
                                <i class="ti-ruler-alt" title="ti-ruler-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2" style="background-color: #977640">
                            <div class="dash-counts">
                                <h4>{{ $totalColors }}</h4>
                                <h5>Colors</h5>
                                <a class="btn btn-primary" href="{{ route('colorPage') }}">
                                    View Info
                                </a>
                            </div>
                            <div class="dash-imgs">
                                <i class="ti-palette" title="ti-palette"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash">
                            <div class="dash-widgetimg ">
                                <span><img src="{{ asset('assets/img/icons/dash1.svg') }}" alt="img" /></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>
                                    <span class="counters" data-count="{{ $totalItem }}">{{ $totalItem }}</span>
                                </h5>
                                <h6>Inventory Items <a class="btn btn-primary" href="{{ route('reportSingleItem') }}">
                                        View Report
                                    </a>
                                </h6>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1" style="background-color: #ff7857">
                            <div class="dash-counts">
                                <h4>{{ $withBalance }}</h4>
                                <h5>Customer with Balance</h5>
                                @if ($withBalance === 0)
                                @else
                                    <form method="GET" action="{{ route('filterDueDate') }}">
                                        <input type="hidden" name="withBalance" value="{{ $withBalance }}">
                                        <button class="btn btn-priimary"
                                            style="background-color:#ef9c87; color: white;">Check
                                            now</button>
                                    </form>
                                @endif
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="minus-circle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1" style="background-color: rgb(196, 19, 19)">
                            <div class="dash-counts">
                                <h4>{{ $overDuerent }}</h4>
                                <h5>Overdue Rents</h5>
                                @if ($overDuerent === 0)
                                @else
                                    <form method="GET" action="{{ route('filterDueDate') }}">
                                        <input type="hidden" name="overDue" value="{{ $overDuerent }}">
                                        <button class="btn btn-priimary"
                                            style="background-color:rgb(198, 77, 77); color: white;">Check
                                            now</button>
                                    </form>
                                @endif
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="alert-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="s-line" class="chart-set"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>



                {{-- <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('filterDueDate') }}">
                            @csrf
                            <div class="row">

                                <div class="col-sm-4">
                                    <h6 style="font-weight: bold;">For Due Date</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">Start Date:</label>
                                            <input type="date" name="Duestart_date" class="form-control">

                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">End Date:</label>
                                            <input type="date" name="Dueend_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h6 style="font-weight: bold;">For Event Date</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">Start Date:</label>
                                            <input type="date" name="Eventstart_date" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">End Date:</label>
                                            <input type="date" name="Eventend_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h6 style="font-weight: bold;">For Transaction Date</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">Start Date:</label>
                                            <input type="date" name="Transactionstart_date" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">End Date:</label>
                                            <input type="date" name="Transactionend_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top:5px">
                                    <button class="btn btn-primary btn-xs" type="submit">Filter
                                    </button>
                                    <a href="{{ url('home') }}" class="btn btn-primary btn-xs">
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <div style="margin-top: 5px" class="table-responsive">
                            <table id="example">
                                <thead>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>Event Date</th>
                                        <th>Transaction Date</th>
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
                                            <td>{{ \Carbon\Carbon::parse($rentor->event_date)->format('M d, Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($rentor->created_at)->format('M d, Y') }}
                                            </td>
                                            <td>
                                                <p>{{ $rentor->last_name }} {{ $rentor->first_name }}</p>
                                            </td>
                                            <td>
                                                @if ($rentor->balance === '0.00')
                                                    <span class="badges bg-lightgreen">Fully Paid</span>
                                                @else
                                                    <p>&#8369; {{ number_format($rentor->balance, 2, '.', ',') }}</p>
                                                @endif
                                            </td>
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
                                                        <img id="see"
                                                            src="{{ asset('assets/img/icons/eye.svg') }}"
                                                            alt="img">
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>Event Date</th>
                                        <th>Transaction Date</th>
                                        <th>Rentor Name</th>
                                        <th>Balance</th>
                                        <th>Rent Type</th>
                                        <th>Status</th>
                                        <th>More Details</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <style>
                            #see:hover {
                                transform: scale(1.1);
                            }
                        </style>
                    </div>
                </div> --}}
            </div>
        </div>


        </div>
        </div>
        </div>


        {{-- for crazy --}}
        <script type="text/javascript">
            $(document).ready(function() {
                var today = new Date();
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'csv',
                            title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                                '-' + today.getDate(),
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                                '-' + today.getDate(),
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                                '-' + today.getDate(),
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                    ],

                });
            });
        </script>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

        {{-- for crazy --}}


        {{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script> --}}

        <script src="{{ asset('assets/js/feather.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>



        {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script> --}}

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script> --}}
        <script>
            "use strict";
$(document).ready(function () {
    function generateData(baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
            var y =
                Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
                yrange.min;
            var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;
            series.push([x, y, z]);
            baseval += 86400000;
            i++;
        }
        desk;
        return series;
    }


    if ($("#s-line").length > 0) {
        var sline = {
            chart: {
                height: 350,
                type: "line",
                zoom: { enabled: false },
                toolbar: { show: false },
            },
            dataLabels: { enabled: false },
            stroke: { curve: "straight" },
            series: [
                {
                    name: "Revenue",
                    data: [
                        {{$janSum}}, {{$febSum}}, {{$marSum}}, {{$aprSum}}, {{$maySum}}, {{$junSum}}, {{$julSum}}, {{$augSum}},
                        {{$sepSum}}, {{$octSum}}, {{$novSum}}, {{$decSum}},
                    ],
                },
            ],
            title: { text: "Total Revenue by months", align: "left" },
            grid: { row: { colors: ["#f1f2f3", "transparent"], opacity: 0.5 } },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                    
                ],
            },
        };
        var chart = new ApexCharts(document.querySelector("#s-line"), sline);
        chart.render();
    }
});
        </script>

        {{-- <script src="{{ asset('assets/plugins/chartjs/chart.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/chartjs/chart-data.js')}}"></script> --}}

        <script src="{{ asset('assets/js/script.js') }}"></script>
        </body>

        </html>
