    @include('admin.partials.header');
    @include('admin.partials.sidenav');
    <style>
        #ney {
            margin-top: -30px;
            margin-bottom: -40px;
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
                        <div class="col-lg-6">
                            @if ($rentor->status === 'Renting')
                                <p id="yen">Status: <span class="badges bg-lightyellow">Renting</span></p>
                            @elseif ($rentor->status === 'Overdue')
                                <p id="yen">Status: <span class="badges bg-lightred">Overdue</span></p>
                            @else
                                <p id="yen">Status: <span class="badges bg-lightgreen">Returned</span></p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <p id="yen"><strong>Transaction Code: </strong><span
                                    id="code">{{ $rentor->transac_code }}</span>
                            </p>
                        </div>
                    </div>
                    @if (session()->has('message'))
                        <h1>{{ session('message') }}</h1>
                    @endif
                    <div style="margin-top: 5px" class="card">
                        <div class="card-body">
                            {{-- <div class="page-header "> --}}
                            <div class="row">
                                <div class="col-sm-8 " style="line-height: 5px;">
                                    {{-- <div class="page-title"> --}}
                                    <p style="font-weight: bold; text-transform: uppercase; font-size: 170%;">
                                        {{ $rentor->first_name }}
                                        {{ $rentor->last_name }}</p>
                                    <p><strong>Address: </strong>{{ $rentor->address }}</p><strong></strong>
                                    <p><strong>Contact Number: </strong>{{ $rentor->contact_num }}</p>
                                    <p><strong>Rent Type: </strong> {{ $rentor->rent_type }}</p>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-sm-4" style="line-height: 5px; margin-top: 15px;">
                                    {{-- <div class="page-title"> --}}
                                    <p><strong>Transaction Date: </strong>
                                        {{ \Carbon\Carbon::parse($rentor->created_at)->format('M j, Y h:i:s A') }}</p>
                                    <p><strong>Event Start Date: </strong>
                                        {{ \Carbon\Carbon::parse($rentor->event_date)->format('M d, Y') }}</p>
                                    <p><strong>Due Date: </strong>
                                        {{ \Carbon\Carbon::parse($rentor->return_date)->format('M d, Y') }}</p>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            {{-- </div> --}}
                            <div style="margin-top: 15px; padding: 10px;">
                                <div class="row">
                                    <div id="see" class="col-sm-6" style=" padding: 10px">
                                        <p style=" font-size: 150%;">
                                            CHARGES
                                        </p>
                                        <div class="col-sm-12" style="margin-top: -10px">
                                            <div class="row">
                                                <hr>
                                                @foreach ($rentedItems as $rentedItem)
                                                    <div class="col-sm-6" style="">
                                                        @if ($rentedItem->single_item_id === null)
                                                            @php
                                                                $productSet = \App\Models\product_set::find($rentedItem->product_set_id);
                                                            @endphp
                                                            <p>{{ $productSet->name }}({{ $productSet->color->name }})(SET
                                                                ITEM) ({{ $rentedItem->quantity }}PC(S))
                                                            </p>
                                                        @else
                                                            @php
                                                                $productItem = \App\Models\item::find($rentedItem->single_item_id);
                                                            @endphp
                                                            <p>{{ $productItem->name }},
                                                                {{ $productItem->color->name }}(SINGLE
                                                                ITEM) ({{ $rentedItem->quantity }}PC(S))
                                                            </p>
                                                        @endif

                                                    </div>
                                                    <div class="col-sm-6"
                                                        style="display: flex; justify-content: flex-end;">
                                                        <p>&#8369;{{ number_format($rentedItem->pricing, 2, '.', ',') }}
                                                        </p>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="col-sm-12"
                                                    style="background-color: #bd9a62; color: white; font-size: 170%;">
                                                    <div class="row">
                                                        <div class="col-sm-6" style="">
                                                            <p>TOTAL
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-6"
                                                            style="display: flex; justify-content: flex-end;">
                                                            <p>&#8369;{{ number_format($rentor->totalPrice, 2, '.', ',') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="padding: 10px;"></div>
                                    <div id="see" class="col-sm-5" style="padding: 10px;">
                                        <p style=" font-size: 150%;">
                                            BALANCE
                                        <div class="row"
                                            style="background-color: #bd9a62; color: white; font-size: 170%;margin-left:5px">
                                            <div class="col-sm-6" style="">
                                                <p>AMOUNT
                                                </p>
                                            </div>
                                            <div class="col-sm-6" style="display: flex; justify-content: flex-end;">
                                                <p>&#8369; {{ number_format($rentor->balance, 2, '.', ',') }}</p>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 tabs_wrapper">
                    <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                        <li id="rentedItems">
                            <a class="product-details">
                                <h6>Rented Item(s)</h6>
                            </a>
                        </li>
                        <li class="active" id="payments">
                            <a class="product-details">
                                <h6>Payment(s)</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tabs_container">
                        <div class="tab_content" data-tab="rentedItems">
                            <div class="row">
                                @foreach ($rentedItems as $rentedItem)
                                    <div class="col-lg-3 col-sm-6 d-flex">
                                        @if ($rentedItem->single_item_id === null)
                                            @php
                                                $productSet = \App\Models\product_set::find($rentedItem->product_set_id);
                                            @endphp
                                            <div class="productset flex-fill active">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/product_images/' . $productSet->productImage) }}"
                                                        alt="img">
                                                    <h6>{{ $productSet->set_code }}</h6>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h4>{{ $productSet->name }}|{{ $productSet->color->name }}</h4>
                                                    <h6>Set Item</h6>
                                                    @if ($rentedItem->status !== 'Rented')
                                                        <a href="javascript:void(0);" class="btn btn-remove">
                                                            Renturned
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn btn-adds"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop{{ $productSet->id }}">
                                                            Set as Renturned
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal fade" id="staticBackdrop{{ $productSet->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Return
                                                                Set Item</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/returnSetRent') }}" method="POST">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <h4 style="color:red">Are you sure to set
                                                                                this
                                                                                as Returned?</h4>
                                                                        </center>
                                                                        <div class="col-sm-12">
                                                                            <h5>This item Set consist(s) of
                                                                                {{ $rentedItem->quantity }} set(s) of
                                                                                items
                                                                                including the following:</h5>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="row">
                                                                                @php
                                                                                    $setItems = \App\Models\Item_details::where('set_id', $id)
                                                                                        ->where('set_id2', $rentedItem->product_set_id)
                                                                                        ->where('status', 'Rented')
                                                                                        ->get();
                                                                                @endphp
                                                                                @foreach ($setItems as $setI)
                                                                                    <div
                                                                                        class="col-lg-3 col-sm-6 d-flex">
                                                                                        <div
                                                                                            class="productset flex-fill active">
                                                                                            <div class="productsetimg">
                                                                                                <img src="{{ asset('storage/item_images/' . $setI->item->productImage) }}"
                                                                                                    alt="img">
                                                                                                <h6>{{ $setI->item_code }}
                                                                                                </h6>
                                                                                            </div>
                                                                                            <div
                                                                                                class="productsetcontent">
                                                                                                <h6>{{ $setI->item->name }}|{{ $setI->item->color->name }}
                                                                                                </h6>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="rentInfoID"
                                                                    value="{{ $id }}">
                                                                <input type="hidden" name="rentQuantity"
                                                                    value="{{ $rentedItem->quantity }}">
                                                                <input type="hidden" name="set_id"
                                                                    value="{{ $rentedItem->product_set_id }}">

                                                                <div class="modal-footer">
                                                                    <button name="add" type="submit"
                                                                        class="btn btn-primary"
                                                                        style="transition: opacity 0.3s ease; opacity: 1; "onmouseover="this.style.opacity='0.6'"
                                                                        onmouseout="this.style.opacity='1'">
                                                                        Continue
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Cancel
                                                                    </button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @php
                                                $productItem = \App\Models\item::find($rentedItem->single_item_id);
                                            @endphp
                                            <div class="productset flex-fill active">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/item_images/' . $productItem->productImage) }}"
                                                        alt="img">
                                                    <h6>{{ $productItem->item_code }}</h6>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h4>{{ $productItem->name }}|{{ $productItem->color->name }}</h4>
                                                    <h6>Single Item</h6>
                                                    @if ($rentedItem->status !== 'Rented')
                                                        <a href="javascript:void(0);" class="btn btn-remove">
                                                            Renturned
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn btn-adds"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#static{{ $productItem->id }}">
                                                            Set as Renturned
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal fade" id="static{{ $productItem->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Return
                                                                Single Item</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/returnSingleRent') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <h3 style="color:red">Are you sure to set
                                                                                this
                                                                                as Returned?</h3>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <h5>This item consist(s) of
                                                                            {{ $rentedItem->quantity }}pc(s) of item(s)
                                                                            including the following:</h5>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            @php
                                                                                $singleItems = \App\Models\Item_details::where('set_id', $id)
                                                                                    ->where('set_id2', 0)
                                                                                    ->where('status', 'Rented')
                                                                                    ->get();
                                                                            @endphp
                                                                            @foreach ($singleItems as $singleI)
                                                                                <div class="col-lg-3 col-sm-6 d-flex">
                                                                                    <div
                                                                                        class="productset flex-fill active">
                                                                                        <div class="productsetimg">
                                                                                            <img src="{{ asset('storage/item_images/' . $singleI->item->productImage) }}"
                                                                                                alt="img">
                                                                                            <h6>{{ $singleI->item_code }}
                                                                                            </h6>
                                                                                        </div>
                                                                                        <div class="productsetcontent">
                                                                                            <h6>{{ $singleI->item->name }}|{{ $singleI->item->color->name }}
                                                                                            </h6>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="rentInfoID"
                                                                    value="{{ $id }}">
                                                                <input type="hidden" name="rentQuantity"
                                                                    value="{{ $rentedItem->quantity }}">
                                                                <input type="hidden" name="item_id"
                                                                    value="{{ $productItem->id }}">

                                                                <div class="modal-footer">
                                                                    <button name="add" type="submit"
                                                                        class="btn btn-primary"
                                                                        style="transition: opacity 0.3s ease; opacity: 1; "onmouseover="this.style.opacity='0.6'"
                                                                        onmouseout="this.style.opacity='1'">
                                                                        Continue
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab_content active" data-tab="payments">
                            <div class="page-header">
                                <div class="page-title">
                                    {{-- <h4>Product Category list</h4>
                                        <h6>View/Search product Category</h6> --}}
                                </div>
                                <div class="page-btn">
                                    @if ($rentor->balance === '0.00')
                                        <button href="" class="btn btn-remove" disabled>
                                            Add Payment
                                        </button>
                                    @else
                                        <a href="addcategory.php" class="btn btn-added" data-bs-toggle="modal"
                                            data-bs-target="#addCategory">
                                            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1"
                                                alt="img" />
                                            Add Payment
                                        </a>
                                    @endif
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
                                                        src="{{ asset('assets/img/icons/search-white.svg') }}"
                                                        alt="img" /></a>
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
                                                    <th>Paid At</th>
                                                    <th>Amount</th>
                                                    <th>Remarks</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $payment)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('M j, Y h:i:s A') }}
                                                        </td>
                                                        <td>{{ number_format($payment->payments, 2, '.', ',') }}</td>
                                                        <td>{{ $payment->remarks }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addCategory" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Add Payment
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                &times;
                                            </button>
                                        </div>
                                        <form action="{{ url('/addPayment') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Enter Amount:</label>
                                                    <input name="payment" type="number" id="priceInput"
                                                        class="form-control" autocomplete="off" required />
                                                    <input name="currentBal" type="hidden"
                                                        value="{{ $rentor->balance }}">
                                                    <input name="target" type="hidden"
                                                        value="{{ $rentor->id }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label">Remarks:</label>
                                                    <textarea name="remarks" class="form-control" cols="30" rows="6"></textarea>
                                                    <input name="rentid" type="hidden"
                                                        value="{{ $id }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button name="add" type="submit" class="btn btn-primary"
                                                    style="transition: opacity 0.3s ease; opacity: 1; "onmouseover="this.style.opacity='0.6'"
                                                    onmouseout="this.style.opacity='1'">
                                                    Continue
                                                </button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('priceInput').addEventListener('input', function() {
            const maxPrice = parseInt({{ $rentor->balance }});
            const enteredPrice = parseFloat(this.value);

            if (isNaN(enteredPrice)) {
                this.value = '';
            } else if (enteredPrice > maxPrice) {
                this.value = maxPrice;
            } else {
                this.value = Math.floor(enteredPrice);
            }
        });
        document.getElementById('priceInput').setAttribute('max', {{ $rentor->balance }});
    </script>
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
