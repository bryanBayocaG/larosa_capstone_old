@include('admin.partials.header');
@include('admin.partials.sidenav');
<style>
    #ney {
        margin-top: -30px;
    }

    .info {
        line-height: none;
    }

    #code {
        color: #bd9a62;
    }

    #see {
        border: 1px solid #bd9a62;
        border-radius: 5px;
    }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div id ="ney" class="col-lg-12 col-sm-12">
                <div class="row">

                    <div class="col-lg-12">
                        <p id="yen">Item Code: <span id="code">{{ $item->item_code }}</span>
                        </p>
                    </div>
                </div>
                <div style="margin-top: 5px" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2 " style="">
                                <img style="" src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                    alt="img">
                            </div>
                            <div class="col-sm-8" style=" margin-top: 15px;">
                                <div class="row">
                                    <div id="see" class="col-sm-12" style="">
                                        <p>
                                            <center style="background-color: #bd9a62; color: white; font-size: 170%;">
                                                {{ $item->name }}</center>
                                        </p>
                                        <hr>
                                        <div class="col-sm-12" style="margin-top: -10px">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p>Color: <span id="code">{{ $item->color->name }}</span></p>
                                                    <p>Total Pieces: <span id="code">{{ $item->quantity->total }}
                                                            pc(s)</span></p>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p>Category: <span
                                                            id="code">{{ $item->itemCategory->name }}</span></p>
                                                    </p>
                                                    <p>Available Pieces: <span
                                                            id="code">{{ $item->quantity->remaining }} pc(s)</span>
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div style="margin-top: 1rem">
                                    {!! QrCode::size(160)->generate($item->link) !!}
                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate($item->link)) !!} "> --}}
                                    {{-- <img src="{!! QrCode::format('png')->generate($item->link) !!}"> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end" style="margin-top: 10px">
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a href="{{ url('download_pdf', $item->id) }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Download PDF"><img
                                                    src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img" /></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('print_pdf', $item->id) }}" target="_blank"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Print QR code"><img
                                                    src="{{ asset('assets/img/icons/printer.svg') }}"
                                                    alt="img" /></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table datanew">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Included Set</th>
                                    <th>Status</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Included Set</th>
                                    <th>Status</th>
                                    <th>Availability</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($thoseItems as $items)
                                    <tr>
                                        <td>{{ $item->name }} - {{ $items->item_code }}</td>
                                        <td>
                                            @if ($items->set_id2 !== 0)
                                                @php
                                                    $productSet = \App\Models\product_set::find($items->set_id2);
                                                @endphp
                                                <a href="{{ url('inventory/set/detail/' . $productSet->id) }}"><span
                                                        class="badges bg-lightyellow">{{ $productSet->name }}</span></a>
                                            @else
                                                <p>None</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($items->status === 'in-possesion')
                                                <span class="badges bg-lightgreen">In-Possesion</span>
                                            @else
                                                <span class="badges bg-lightyellow">Rented</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($items->status === 'in-possesion' && $items->set_id2 === 0)
                                                <span class="badges bg-lightgreen">Available</span>
                                            @else
                                                <span class="badges bg-lightred">Not Available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('asset/js/html5-qrcode.min.js') }}"></script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@livewireScripts
</body>

</html>
