@include('admin.partials.header');
@include('admin.partials.sidenav');
<div class="page-wrapper">
    <div class="content">
        <div class="page-header ">
            <div class="page-title">
                <h4>ITEM REPORT</h4>
                <h6>Customize your Reports using Filters and Export/Print</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="dash-count das2" style="background-color: rgb(37, 37, 197)">
                    <div class="dash-counts">
                        <h4>{{ $totalItems }}</h4>
                        <h5>Total No. of Items</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="tag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="dash-count das2" style="background-color: rgb(214, 156, 49)">
                    <div class="dash-counts">
                        <h4>{{ $totalRented }}</h4>
                        <h5>Total No. of Rented Items</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="minus-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="dash-count das2" style="background-color: green">
                    <div class="dash-counts">
                        <h4>{{ $totalAvailable }}</h4>
                        <h5>Total No. of Available Available</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="dash-count das1" style="background-color: #ff7857">
                    <div class="dash-counts">
                        <h4>{{ $damagedItem }}</h4>
                        <h5>Damaged</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="minus-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 d-flex">
                <div class="dash-count das1" style="background-color: rgb(196, 19, 19)">
                    <div class="dash-counts">
                        <h4>{{ $totalMissing }}</h4>
                        <h5>Missing</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="alert-circle"></i>
                    </div>
                </div>
            </div>
        </div>




        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('filterSingleItem') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <h6>Filter by: </h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select name="setVal" id="" class="form-control">
                                        <option value="0" hidden>Choose Set Status</option>
                                        <option value="1">In Set</option>
                                        <option value="2">Not in Set</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="state" id="" class="form-control">
                                        <option value="none" hidden>Choose Item State</option>
                                        <option value="Rented">Rented</option>
                                        <option value="Available">Available</option>
                                        <option value="Overdue">Overdue</option>
                                        <option value="Damaged">Damaged</option>
                                        <option value="Missing">Missing</option>

                                    </select>
                                </div>
                            </div>
                            <div style="margin-top: 5px; margin-bottom:5px;text-align: right;">
                                <button class="btn btn-primary btn-sm" type="submit">Filter
                                </button>
                                <a href="{{ url('reportSingleItem') }}" class="btn btn-primary btn-sm">
                                    Reset Filter
                                </a>
                            </div>
                        </div>



                    </div>
                </form>

                <div class="table-responsive">
                    <table id="example">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>Rentor Name</th>
                                <th>Rent Due Date</th>
                                <th>Overdue</th>
                                <th>Damaged</th>
                                <th>Included Set</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->item->name }} - {{ $item->item_code }}
                                    </td>
                                    <td>
                                        @if ($item->status === 'in-possesion')
                                            <span class="badges bg-lightgreen">In-Possesion</span>
                                        @else
                                            <span class="badges bg-lightyellow">Rented</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'Rented')
                                            @php
                                                $rentIfo = \App\Models\RentInfo::find($item->set_id);
                                            @endphp
                                            <p>{{ $rentIfo->last_name }} {{ $rentIfo->first_name }}</p>
                                        @else
                                            <p style="color: gray">NONE</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'Rented')
                                            @php
                                                $rentIfo = \App\Models\RentInfo::find($item->set_id);
                                            @endphp
                                            <p>{{ \Carbon\Carbon::parse($rentIfo->return_date)->format('M d, Y') }}</p>
                                        @else
                                            <p style="color: gray">NONE</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'Rented')
                                            @php
                                                $rentIfo = \App\Models\RentInfo::find($item->set_id);
                                            @endphp
                                            @if ($rentIfo->status !== 'Overdue')
                                                <span class="badges bg-lightgreen">No</span>
                                            @else
                                                <span class="badges bg-lightred">Yes</span>
                                            @endif
                                        @else
                                            <p style="color: gray">NONE</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->state === 'Damage')
                                            <span class="badges bg-lightred">Yes</span>
                                        @else
                                            <span class="badges bg-lightgreen">No</span>
                                        @endif
                                    </td>
                                    <td style="color: gray">
                                        @if ($item->set_id2 !== 0)
                                            @php
                                                $productSet = \App\Models\product_set::find($item->set_id2);
                                            @endphp
                                            <span class="badges bg-lightyellow">{{ $productSet->name }}</span>
                                            {{ $productSet->quantity }}x
                                        @else
                                            <p style="color: gray">NONE</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'in-possesion' && $item->set_id2 === 0)
                                            <span class="badges bg-lightgreen">Available</span>
                                        @else
                                            <span class="badges bg-lightred">Not Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Item Name</th>
                                <th>Status</th>

                                <th>Rentor Name</th>
                                <th>Rent Due Date</th>
                                <th>Overdue</th>
                                <th>Damaged</th>
                                <th>Included Set</th>
                                <th>Availability</th>
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
        </div>
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

                },
                {
                    extend: 'csv',
                    title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                        '-' + today.getDate(),

                },
                {
                    extend: 'excel',
                    title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                        '-' + today.getDate(),

                },
                {
                    extend: 'pdf',
                    title: 'Report_' + today.getFullYear() + '-' + (today.getMonth() + 1) +
                        '-' + today.getDate(),

                },
                {
                    extend: 'print',

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
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
