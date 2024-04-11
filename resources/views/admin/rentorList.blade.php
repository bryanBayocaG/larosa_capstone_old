@include('admin.partials.header');
@include('admin.partials.sidenav');
<style>
    #see:hover {
        transform: scale(1.1);
    }
</style>
<div class="page-wrapper">
    <div class="content">
        <div>
            <div class="row">
                <div class="col-sm-8">

                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            @php
    use Carbon\Carbon;
@endphp

{{-- Assuming $time is the 24-hour format time --}}
@php
    $formattedTime = Carbon::createFromFormat('H:i', $setTimeValue)->format('g:i A');
@endphp
                            <h6 style="font-weight: bold;">Setted Time for Reminders: <span style="color: #BD9A62">{{$formattedTime}}</span></h6>
                            <form action="{{ route('setTime') }}" method="POST">
                                @csrf
                                <select name="time" id="" class="form-control">
                                    <option value="{{$setTimeValue}}" hidden>Choose Time to Set</option>
                                    <Option value="01:39">8:00 AM</Option>
                                    <Option value="09:00">9:00 AM</Option>
                                    <Option value="10:00">10:00 AM</Option>
                                    <Option value="11:00">11:00 AM</Option>
                                    <Option value="12:00">12:00 PM</Option>
                                    <Option value="13:00">1:00 PM</Option>
                                    <Option value="14:00">2:00 PM</Option>
                                    <Option value="15:00">3:00 PM</Option>
                                    <Option value="16:00">4:00 PM</Option>
                                </select>
                                <br>
                                <button style="width: 100%" class="btn btn-primary btn-xs" type="submit">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
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
        </div>


    </div>
</div>
</div>
@livewireScripts
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

<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
