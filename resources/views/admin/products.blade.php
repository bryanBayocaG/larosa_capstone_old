        @include('admin.partials.header');
        @include('admin.partials.sidenav');
        <style>
            .productset .productsetimg {
                height: 200px;
            }
        </style>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product List</h4>
                        <h6>Manage your Inventory</h6>
                    </div>
                    <div class="page-btn">
                        {{-- <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#registerProd">
                            <img src="{{ asset('assets/img/icons/product.svg') }}" class="me-1" alt="img" />
                            Create a product set
                        </a> --}}
                        <a href="{{ url('inventory/productset/addProductSet') }}" class="btn btn-added">
                            <img src="{{ asset('assets/img/icons/product.svg') }}" class="me-1" alt="img" />
                            Create a product set
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
                        @foreach ($categ as $category)
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
                                @forelse ($Products as $product)
                                    <div class="col-lg-2 col-sm-4 d-flex ">
                                        <a href="{{ url('inventory/set/detail/' . $product->id) }}">
                                            <div class="productset flex-fill">
                                                <div class="productsetimg" style="">
                                                    <img src="{{ asset('storage/product_images/' . $product->productImage) }}"
                                                        alt="img">
                                                </div>
                                                <div class="productsetcontent">

                                                    <h6>{{ $product->name }}</h6>
                                                    <p>Category: {{ $product->category->name }} <br>
                                                        Quantity: {{ $product->remaining }}/{{ $product->quantity }}
                                                    </p>
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

                        {{-- @foreach ($combi as $category)
                            <div class="tab_content" data-tab="{{ $category->name }}">
                                <div class="row">
                                    @if ($category->products)
                                        @foreach ($category->products as $item)
                                            <div class="col-lg-2 col-sm-4 d-flex ">
                                                <a href="{{ url('inventory/products/varietyfor/' . $product->id) }}">
                                                    <div class="productset flex-fill">
                                                        <div class="productsetimg">
                                                            <img src="{{ asset('storage/product_images/' . $item->productImage) }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="productsetcontent">
                                                            <h6>{{ $item->name }}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach --}}
                        @foreach ($categ as $category)
                            <div class="tab_content" data-tab="{{ $category->name }}">
                                <div class="row">
                                    <h1>to be follow</h1>
                                    {{-- @if ($category->products)
                                    @foreach ($category->products as $item)
                                        <div class="col-lg-2 col-sm-4 d-flex ">
                                            <a href="{{ url('inventory/products/varietyfor/' . $product->id) }}">
                                                <div class="productset flex-fill">
                                                    <div class="productsetimg">
                                                        <img src="{{ asset('storage/product_images/' . $item->productImage) }}"
                                                            alt="img">
                                                    </div>
                                                    <div class="productsetcontent">
                                                        <h6>{{ $item->name }}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade bd-example-modal-lg" id="registerProd" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Register a Product Set
                        </h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            &times;
                        </a>
                    </div>
                    <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label> Product Set Image</label>
                                        <div style="" class="container" class="image-upload">
                                            <input name="image" type="file" class="form-control"
                                                onchange="loadFile(event)">
                                            <div style="margin-top:5px;padding:5px;" class="image-uploads">
                                                <center>
                                                    <img style="height:fit-content;border-radius:5px;" id="output"
                                                        src="{{ asset('assets/img/icons/upload.svg') }}"
                                                        alt="img">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="color:red;margin-top:-20px;">Upload only jpeg,png,jpg,gif files with
                                        Maximum
                                        of 2(MB)</p>
                                </div>
                                <div class="col-sm-7">
                                    <div class="mb-1">
                                        <label class="col-form-label">Product Set Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-form-label">Product Set Category</label>
                                        <select class="form-control" name="category" class="select" required>
                                            <option value="" hidden>Choose Category</option>
                                            @foreach ($categ as $categories)
                                                <option value="{{ $categories->id }}"> {{ $categories->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-form-label">Product Set Color</label>
                                        <select class="form-control" name="color" class="select" required>
                                            <option value="" hidden>Choose Color</option>
                                            @foreach ($color as $color)
                                                <option value="{{ $color->id }}"> {{ $color->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-form-label">Product Set Size</label>
                                        <select class="form-control" name="size" class="select" required>
                                            <option value="" hidden>Choose Size</option>
                                            @foreach ($size as $size)
                                                <option value="{{ $size->id }}"> {{ $size->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3">
                                    <label class="col-form-label">Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="4"></textarea>
                                </div> --}}
                                    <div class="modal-footer">
                                        <button name="add" type="submit" class="btn btn-primary"
                                            style="color:white;">
                                            Register
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
        @livewireScripts
        </body>

        </html>
