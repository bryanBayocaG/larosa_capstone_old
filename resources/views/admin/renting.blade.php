<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Larosa</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/picture/Larosa.jpg') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}" />
    @livewireStyles
</head>

<body>
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}
    @if (session('success'))
        <script>
            setTimeout(function() {
                toastr.success("{{ Session::get('success') }}", "Action Succesfull!")
            }, 100);
        </script>
    @endif
    @if (session('error'))
        <script>
            setTimeout(function() {
                console.log('Session Error variable: {{ session('error') }}');
                Swal.fire({
                    icon: "error",
                    title: "Nothing Match",
                    text: `{{ session('error') }}`

                });
                setTimeout(function() {
                    @php
                        session()->forget('error');
                    @endphp
                }, 100);
            }, 100);
        </script>
    @endif
    @if (session('errors'))
        <script>
            setTimeout(function() {
                console.log('Session Error variable: {{ session('error') }}');
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: `{{ session('errors') }}`
                });
                setTimeout(function() {
                    @php
                        session()->forget('error');
                    @endphp
                }, 1000);
            }, 2000);
        </script>
    @endif

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- @if (session('success'))
        <script>
            setTimeout(function() {
                console.log('Session variable: {{ session('success') }}');
                $(document).ready(function() {
                    $('#yow').modal('show');
                });
            }, 1500);
        </script>
    @endif --}}

    @if (session()->has('matchItem'))
        @php
            $matchItem = session('matchItem');
        @endphp

        <script>
            setTimeout(function() {
                console.log('Session variable hehehehe: {{ session('matchItem') }}');
                $(document).ready(function() {
                    $('#yow').modal('show');
                });
            }, 300);
        </script>
    @endif

    @if (session()->has('mathSet'))
        @php
            $mathSet = session('mathSet');
        @endphp

        <script>
            setTimeout(function() {
                console.log('Session variable hehehehe: {{ session('mathSet') }}');
                $(document).ready(function() {
                    $('#yow2').modal('show');
                });
            }, 300);
        </script>
    @endif




    <div class="main-wrappers">

        @include('admin.partials.renoutHeader');

        <div class="page-wrapper ms-0">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 tabs_wrapper">
                        <div class="page-header ">
                            <div class="page-title">
                                <h4>Rent Out</h4>
                                <h6>Manage your Transactions</h6>
                            </div>
                        </div>
                        <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                            <li class="active" id="All">
                                <a class="product-details">
                                    <h6>All Set</h6>
                                </a>
                            </li>
                            <li id="item">
                                <div class="product-details ">
                                    <h6>All Item</h6>
                                </div>
                            </li>
                        </ul>
                        <div class="tabs_container">
                            <div class="tab_content active" data-tab="All">
                                {{-- @livewire('show-set') --}}
                                <div class="row ">
                                    @forelse ($sets as $set)
                                        <div class="col-lg-3 col-sm-6 d-flex">
                                            <div class="productset flex-fill">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/product_images/' . $set->productImage) }}"
                                                        alt="img">
                                                    <h6>In-stock: {{ $set->remaining }}</h6>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h5>{{ $set->name }}</h5>

                                                    @if ($cart->where('id', $set->id)->first())
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
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="addToCart{{ $set->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h5 class="modal-title" id="variantDetailsModalLabel">
                                                                    Add <span id="productName">
                                                                    </span> to
                                                                    Cart</h5>
                                                            </div>
                                                            <p>Product Code: <span
                                                                    id="topcode">{{ $set->set_code }}</span></p>
                                                            <p>Available Quantity: <span
                                                                    id="topcode">{{ $set->remaining }}</span></p>
                                                        </div>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('cart.store') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <img src="{{ asset('storage/product_images/' . $set->productImage) }}"
                                                                        alt="Variant Image">
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="mb-3">
                                                                        <div class="mb-2">
                                                                            <input type="hidden" name="setID"
                                                                                value="{{ $set->id }}">
                                                                            <input type="hidden" name="currentQuan"
                                                                                value="{{ $set->remaining }}">
                                                                            <label for="colorInput"
                                                                                class="form-label">Color</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $set->color->name }}"
                                                                                name="color" readonly>
                                                                        </div>
                                                                        <div class="mb-2">

                                                                            <label for="sizeInput"
                                                                                class="form-label">Category</label>
                                                                            <input type="text" class="form-control"
                                                                                id="sizeInput"
                                                                                value="{{ $set->category->name }}"
                                                                                name="category" readonly>
                                                                        </div>

                                                                        <div class="mb-2">
                                                                            <label for="pricing"
                                                                                class="form-label">Quantity</label>
                                                                            <input type="number" min="1"
                                                                                max="{{ $set->remaining }}"
                                                                                class="form-control" id="pricing"
                                                                                name="quantity" required>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label for="pricing"
                                                                                class="form-label">Pricing Set</label>
                                                                            <input class="form-control" type="number"
                                                                                min="1" id="priceSet"
                                                                                name="price" required>
                                                                        </div>
                                                                        <input type="hidden" class="form-control"
                                                                            id="idInput" name="var_id">
                                                                        <input type="hidden" class="form-control"
                                                                            id="codeInput" name="code">
                                                                        <input type="hidden" class="form-control"
                                                                            id="productInput" name="product">
                                                                        <input type="hidden" class="form-control"
                                                                            id="imgInput" name="imgname">
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <button id="addme"
                                                                            class="btn form-control"
                                                                            type="submit">Add to
                                                                            Cart</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <center>
                                            @include('admin.partials.noProduct')
                                        </center>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab_content" data-tab="item">
                                {{-- @livewire('products-table') --}}
                                <div class="row">
                                    @forelse ($items as $item)
                                        <div class="col-lg-3 col-sm-6 d-flex">
                                            <div class="productset flex-fill">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                                        alt="img">
                                                    <h6>Available In-stock: {{ $item->quantity->remaining }}</h6>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h5>{{ $item->name }}</h5>
                                                    @if ($cart->where('id', $item->id)->first())
                                                        <h6>In-Cart</h6>
                                                    @elseif ($item->quantity->remaining === 0)
                                                        <h6>Out of Available stock</h6>
                                                    @else
                                                        <a href="javascript:void(0);" class="btn btn-adds"
                                                            data-product-id="{{ $item->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addToCart{{ $item->id }}">
                                                            Add to Cart
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="addToCart{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h5 class="modal-title" id="variantDetailsModalLabel">
                                                                    Add <span id="productName">
                                                                    </span> to
                                                                    Cart</h5>
                                                            </div>
                                                            <p>Product Code: <span
                                                                    id="topcode">{{ $item->item_code }}</span></p>
                                                            <p>Available Quantity: <span
                                                                    id="topcode">{{ $item->quantity->remaining }}</span>
                                                            </p>
                                                        </div>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('cart.storeI') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                                                        alt="Variant Image">
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="mb-3">
                                                                        <div class="mb-2">
                                                                            <input type="hidden" name="setID"
                                                                                value="{{ $item->id }}">
                                                                            <input type="hidden" name="currentQuan"
                                                                                value="{{ $item->quantity->remaining }}">
                                                                            <label for="colorInput"
                                                                                class="form-label">Color</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $item->color->name }}"
                                                                                name="color" readonly>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label for="sizeInput"
                                                                                class="form-label">Category</label>
                                                                            <input type="text" class="form-control"
                                                                                id="sizeInput"
                                                                                value="{{ $item->itemCategory->name }}"
                                                                                name="category" readonly>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label for="pricing"
                                                                                class="form-label">Quantity</label>
                                                                            <input type="number" min="1"
                                                                                max="{{ $item->quantity->remaining }}"
                                                                                class="form-control" id="pricing"
                                                                                name="quantity" required>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <label for="pricing"
                                                                                class="form-label">Pricing Item</label>
                                                                            <input class="form-control" min="1"
                                                                                type="number" id="priceItem"
                                                                                name="price" required>
                                                                        </div>
                                                                        <input type="hidden" class="form-control"
                                                                            id="idInput" name="var_id">
                                                                        <input type="hidden" class="form-control"
                                                                            id="codeInput" name="code">
                                                                        <input type="hidden" class="form-control"
                                                                            id="productInput" name="product">
                                                                        <input type="hidden" class="form-control"
                                                                            id="imgInput" name="imgname">
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <button id="addme"
                                                                            class="btn form-control"
                                                                            type="submit">Add to
                                                                            Cart</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <center>
                                            @include('admin.partials.noProduct')
                                        </center>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 ">
                        <div class="card card-order">
                            <div class="split-card">
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a class="btn btn-scanner-set" type="button" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <img src="{{ asset('assets/img/icons/qr-code-scan-icon.svg') }}"
                                            alt="img" class="me-2" />
                                        Scan QR Code
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="card-body pt-0">
                                <div class="totalitem">
                                    @livewire('cart-counter')
                                    <a href="{{ url('cartRemoveAll') }}">Clear all</a>
                                </div>
                                @livewire('show-cart-items')
                            </div>

                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0 pb-2">
                                @livewire('total-amount')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($cart->count())
                                                <a href="javascript:void(0);" class="btn btn-adds"
                                                    data-bs-toggle="modal" data-bs-target="#create"><i
                                                        class="fa fa-plus me-2"></i>Add
                                                    Customer</a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-remove"><i
                                                        class="fa fa-plus me-2"></i>Add
                                                    Customer</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="btn-pos">
                                    <ul>
                                        <li>
                                            <a class="btn"><img src="assets/img/icons/wallet1.svg" alt="img"
                                                    class="me-1">Payment</a>
                                        </li>
                                        <li>
                                            <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img
                                                    src="assets/img/icons/transcation.svg" alt="img"
                                                    class="me-1"> Transaction</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{ url('checkout') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Check Out</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input name="fname" type="text" class="form-control"
                                                        autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input name="lname" type="text" class="form-control"
                                                        autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input id="phone" name="contactnum" type="text"
                                                        class="form-control" autocomplete="off" required />

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Event Date</label>
                                                    <input name="eventdate" type="date" id="dateInput"
                                                        class="form-control"required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input id="address" class="form-control" name="address"
                                                        type="text" autocomplete="off"
                                                        placeholder="Barangay, District, City/Municipality" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="setvalue">
                                                        <ul>
                                                            <li class="total-value">
                                                                <h5>Total </h5>
                                                                <h6><span>&#8369;</span>&nbsp;{{ Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}
                                                                </h6>
                                                                <input name="rent_type" type="hidden"
                                                                    value="Itemize" required />
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Payment</label>
                                                    <input name="payment" type="number" id="priceInput"
                                                        class="form-control" autocomplete="off" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea name="remarks" class="form-control" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-submit me-2">Check-Out</button>
                                            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (isset($matchItem))
                        <div class="modal fade" id="yow" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5 class="modal-title" id="variantDetailsModalLabel">
                                                    Add <span id="productName">
                                                    </span> to
                                                    Cart</h5>
                                            </div>
                                            <p>Product Code: <span id="topcode">{{ $matchItem->item_code }}</span>
                                            </p>
                                            <p>Available Quantity: <span
                                                    id="topcode">{{ $matchItem->quantity->remaining }}</span>
                                            </p>
                                        </div>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('cart.storeI') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('storage/item_images/' . $matchItem->productImage) }}"
                                                        alt="Variant Image">
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <div class="mb-2">
                                                            <input type="hidden" name="setID"
                                                                value="{{ $matchItem->id }}">
                                                            <input type="hidden" name="currentQuan"
                                                                value="{{ $matchItem->quantity->remaining }}">
                                                            <label for="colorInput" class="form-label">Color</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $matchItem->color->name }}" name="color"
                                                                readonly>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="sizeInput" class="form-label">Category</label>
                                                            <input type="text" class="form-control" id="sizeInput"
                                                                value="{{ $matchItem->itemCategory->name }}"
                                                                name="category" readonly>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="pricing" class="form-label">Quantity</label>
                                                            <input type="number" min="1"
                                                                max="{{ $matchItem->quantity->remaining }}"
                                                                class="form-control" id="pricing" name="quantity"
                                                                required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="pricing" class="form-label">Pricing
                                                                Item</label>
                                                            <input class="form-control" type="number" min="1"
                                                                id="priceItem" name="price" required>
                                                        </div>
                                                        <input type="hidden" class="form-control" id="idInput"
                                                            name="var_id">
                                                        <input type="hidden" class="form-control" id="codeInput"
                                                            name="code">
                                                        <input type="hidden" class="form-control" id="productInput"
                                                            name="product">
                                                        <input type="hidden" class="form-control" id="imgInput"
                                                            name="imgname">
                                                    </div>
                                                    @if ($cart->where('id', $matchItem->id)->first())
                                                        <div class="col-lg-12">
                                                            <a href="javascript:void(0);" class="btn btn-remove">
                                                                In-cart
                                                            </a>
                                                        </div>
                                                    @elseif ($matchItem->quantity->remaining === 0)
                                                        <a href="javascript:void(0);" class="btn btn-remove">
                                                            Out of Stock
                                                        </a>
                                                    @else
                                                        <div class="col-lg-12">
                                                            <button id="addme" class="btn form-control"
                                                                type="submit">Add to
                                                                Cart</button>
                                                        </div>
                                                    @endif

                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        &nbsp;
                    @endif
                    @if (isset($mathSet))
                        <div class="modal fade" id="yow2" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5 class="modal-title" id="variantDetailsModalLabel">
                                                    Add <span id="productName">
                                                    </span> to
                                                    Cart</h5>
                                            </div>
                                            <p>Product Code: <span id="topcode">{{ $mathSet->set_code }}</span></p>
                                            <p>Available Quantity: <span
                                                    id="topcode">{{ $mathSet->remaining }}</span>
                                            </p>
                                        </div>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('storage/product_images/' . $mathSet->productImage) }}"
                                                        alt="Variant Image">
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <div class="mb-2">
                                                            <input type="hidden" name="setID"
                                                                value="{{ $mathSet->id }}">
                                                            <input type="hidden" name="currentQuan"
                                                                value="{{ $mathSet->remaining }}">
                                                            <label for="colorInput" class="form-label">Color</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $mathSet->color->name }}" name="color"
                                                                readonly>
                                                        </div>
                                                        <div class="mb-2">

                                                            <label for="sizeInput" class="form-label">Category</label>
                                                            <input type="text" class="form-control" id="sizeInput"
                                                                value="{{ $mathSet->category->name }}"
                                                                name="category" readonly>
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="pricing" class="form-label">Quantity</label>
                                                            <input type="number" min="1"
                                                                max="{{ $mathSet->remaining }}" class="form-control"
                                                                id="pricing" name="quantity" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="pricing" class="form-label">Pricing
                                                                Set</label>
                                                            <input class="form-control" type="number" min="1"
                                                                id="priceSet" name="price" required>
                                                        </div>
                                                        <input type="hidden" class="form-control" id="idInput"
                                                            name="var_id">
                                                        <input type="hidden" class="form-control" id="codeInput"
                                                            name="code">
                                                        <input type="hidden" class="form-control" id="productInput"
                                                            name="product">
                                                        <input type="hidden" class="form-control" id="imgInput"
                                                            name="imgname">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button id="addme" class="btn form-control"
                                                            type="submit">Add to
                                                            Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        &nbsp;
                    @endif
                    {{-- hehehehehe --}}

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Scan QR code</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <center>
                                        <div id="qr-reader" style="width: 60%"></div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#phone").inputmask({
                "mask": "9999-999-9999",
            });
        });
    </script>

    <script src="https://unpkg.com/html5-qrcode"></script>
    {{-- <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script> --}}
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            try {
                decodedText = decodedText.replace(/(:|\/|\.)+/g, '');
                // const last10Letters = decodedText.slice(-10);
                const url = `/qrCheck/${decodedText}`;
                window.location.href = url;
            } catch (error) {
                console.error('An error occurred:', error);
            }
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250,
                rememberLastUsedCamera: false

            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <script>
        const dateInput = document.getElementById('dateInput');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    </script>
    <script>
        const numericInput = document.getElementById('pricing');
        numericInput.addEventListener('input', function() {
            formatNumber(this);
        });

        function formatNumber(input) {
            input.value = input.value.replace(/[^0-9.]/g, '');
            input.value = addThousandSeparator(input.value);
        }

        function addThousandSeparator(number) {
            if (!number.includes('.')) {
                return number.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            } else {
                const parts = number.split('.');
                const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return integerPart + '.' + parts[1];
            }
        }
    </script>

    <script>
        document.getElementById('priceInput').addEventListener('input', function() {
            if (this.value === '-' || (this.value.includes('-') && event.data === '-')) {
                this.value = this.value.replace('-', '');
            }
            const maxPrice = parseFloat("{{ Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}".replace(/,/g,
                ''));
            const enteredPrice = parseFloat(this.value);
            if (isNaN(enteredPrice)) {
                this.value = '';
            } else if (enteredPrice > maxPrice) {
                this.value = maxPrice;
            } else {
                this.value = Math.floor(enteredPrice);
            }
        });
    </script>

    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('asset/js/html5-qrcode.min.js') }}"></script>

    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    @livewireScripts
</body>

</html>
