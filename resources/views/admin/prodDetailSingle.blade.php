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
                                                    <p>Remaining Pieces: <span
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
            <div class="col-lg-12 col-sm-12 tabs_wrapper">
                <div class="row">
                    {{-- <div class="col-lg-3 col-sm-6 d-flex"> --}}

                    @foreach ($thoseItems as $items)
                        <div class="col-lg-3 col-sm-6 d-flex">
                            <div class="productset flex-fill">
                                <div class="productsetimg">
                                    <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                        alt="img">
                                    <h6>{{ $items->item_code }}</h6>
                                </div>
                                <div class="productsetcontent">
                                    <h5>{{ $item->name }}</h5>
                                    {{-- <p>Status: {{ $items->status }}</p> --}}
                                    <p>Status:
                                        @if ($items->set_id2 !== 0)
                                            @php
                                                $productSet = \App\Models\product_set::find($items->set_id2);
                                            @endphp
                                            <span class="badges bg-lightyellow">{{ $productSet->name }}</span>
                                        @elseif ($items->status === 'in-possesion')
                                            <span class="badges bg-lightgreen">In-Possesion</span>
                                        @else
                                            <span class="badges bg-lightyellow">Renting</span>
                                        @endif
                                    </p>

                                    {{-- @if ($cart->where('id', $set->id)->first())
                                            <h6>In-Cart</h6>
                                        @elseif ($set->remaining === '0')
                                            <h6>Out of Stock</h6>
                                        @else
                                            <a href="javascript:void(0);" class="btn btn-adds"
                                                data-product-id="{{ $set->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addToCart{{ $set->id }}">
                                                Add to Cart
                                            </a>
                                        @endif --}}
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- </div> --}}

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
