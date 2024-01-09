@include('admin.partials.header');
@include('admin.partials.sidenav');

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Single Product List</h4>
                <h6>Manage your Inventory</h6>
            </div>
            <div class="page-btn">
                <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#registerProd">
                    <img src="{{ asset('assets/img/icons/product.svg') }}" class="me-1" alt="img" />
                    Add single Product
                </a>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 tabs_wrapper">
            <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                <li class="active" id="All">
                    <a class="product-details">
                        <h6>All</h6>
                    </a>
                </li>
                @foreach ($icateg as $category)
                    <li id="{{ $category->name }}">
                        <a class="product-details">
                            <h6>{{ $category->name }}</h6>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tabs_container">
                <div class="tab_content active" data-tab="All">
                    <div class="row">
                        @forelse ($items as $item)
                            <div class="col-lg-2 col-sm-4 d-flex ">
                                <a href="{{ url('inventory/items/detail/' . $item->id) }}">
                                    <div class="productset flex-fill">
                                        <div class="productsetimg" style="">
                                            <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                                alt="img">
                                        </div>
                                        <div class="productsetcontent">
                                            <h6>{{ $item->name }}</h6>
                                            <p>Category: {{ $item->itemCategory->name }} <br>
                                                Quantity:
                                                {{ $item->quantity->remaining }}/{{ $item->quantity->total }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <center>
                                @include('admin.partials.noProduct')
                            </center>
                        @endforelse
                    </div>

                </div>

                @foreach ($tabCategories as $category)
                    <div class="tab_content" data-tab="{{ $category->name }}">
                        <div class="row">
                            @if ($category->items)
                                @forelse ($category->items as $item)
                                    @if ($item->stash === null)
                                        <div class="col-lg-2 col-sm-4 d-flex">
                                            {{-- <a href="{{ url('inventory/products/varietyfor/' . $item->id) }}"> --}}
                                            <div class="productset flex-fill">
                                                <div class="productsetimg">
                                                    <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                                        alt="img">
                                                </div>
                                                <div class="productsetcontent">
                                                    <h6>{{ $item->name }}</h6>
                                                </div>
                                            </div>
                                            {{-- </a> --}}
                                        </div>
                                    @endif
                                @empty
                                    <center>
                                        @include('admin.partials.noProduct')
                                    </center>
                                @endforelse
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@include('admin.partials.registerItem')

<script>
    function ThosoundSeparator(event) {
        const inputElement = event.target;
        let inputValue = inputElement.value;
        inputValue = inputValue.replace(/[^0-9]/g, '');
        inputValue = Number(inputValue).toLocaleString('en-US');
        inputElement.value = inputValue;
    }
    document.getElementById('quantity').addEventListener('input', ThosoundSeparator);
</script>

<script type="text/javascript">
    window.addEventListener('closeModal', event => {
        $('#registerProd').modal('hide');
    });
    window.addEventListener('message', event => {
        Swal.fire({
            position: "top-end",
            type: "success",
            title: "Category Added!",
            showConfirmButton: !1,
            timer: 1500,
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: !1,
        });
    });
</script>

<script type="text/javascript">
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
            })
            .then(function(t) {
                t.value ?
                    window.location.href = urlToRedirect

                    :
                    t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: "Cancelled",
                        text: "Action has been Cancelled",
                        type: "error",
                        confirmButtonClass: "btn btn-success",
                    });
            });
    }
</script>
<script type="text/javascript">
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>

<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

{{-- <script src="{{asset('assets/plugins/fileupload/fileupload.min.js')}}"></script> --}}
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
@livewireScripts
</body>

</html>
