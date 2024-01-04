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
                <div style="margin-top: 5px" class="card">
                    <div class="card-body">
                        <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label> Product Set Image</label>
                                        <div style="" class="container" class="image-upload">
                                            <input name="image" type="file" class="form-control"
                                                onchange="loadFile(event)">
                                            <div style="margin-top:5px;padding:5px;" class="image-uploads">
                                                <center>
                                                    <img style="height:fit-content;border-radius:5px;" id="output"
                                                        src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="color:red;margin-top:-20px;">Upload only jpeg,png,jpg,gif files with
                                        Maximum
                                        of 2(MB)</p>
                                </div>
                                <div class="col-sm-9">

                                    <div class="mb-1">
                                        <label class="col-form-label">Product Set Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Product Set Category</label>
                                                <select class="form-control" name="category" class="select" required>
                                                    <option value="" hidden>Choose Category</option>
                                                    @foreach ($categ as $categories)
                                                        <option value="{{ $categories->id }}"> {{ $categories->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Product Set Color</label>
                                                <select class="form-control" name="color" class="select" required>
                                                    <option value="" hidden>Choose Color</option>
                                                    @foreach ($colorses as $color)
                                                        <option value="{{ $color->id }}"> {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Product Set Size</label>
                                                <select class="form-control" name="size" class="select" required>
                                                    <option value="" hidden>Choose Size</option>
                                                    @foreach ($size as $size)
                                                        <option value="{{ $size->id }}"> {{ $size->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @livewire('set-quantity')
                                        </div>
                                    </div>
                                </div>
                                @livewire('register-button')
                            </div>
                        </form>
                        <div class="col-sm-12">
                            <h6>Includes: </h1>
                                @livewire('included-display')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 tabs_wrapper">
                <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                    <li id="addItem">
                        <a class="product-details">
                            <h6>Add Item(s)</h6>
                        </a>
                    </li>
                    <li class="active" id="choosefrom">
                        <a class="product-details">
                            <h6>Choose from Item(s)</h6>
                        </a>
                    </li>
                </ul>
                <div class="tabs_container">
                    <div class="tab_content" data-tab="addItem">
                        <div class="row">
                            @livewire('to-be-added-items')
                            @include('admin.partials.registerItemInSet')
                        </div>
                        {{-- ma add mano mano --}}
                    </div>
                    <div class="tab_content active" data-tab="choosefrom">
                        @livewire('to-be-includ-items')
                        {{-- mapili digdi --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<script type="text/javascript">
    var loadFile2 = function(event) {
        var output = document.getElementById('output2');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
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

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
@livewireScripts
</body>

</html>
