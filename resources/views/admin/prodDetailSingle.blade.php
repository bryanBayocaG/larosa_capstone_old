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
                                                    <p>Size: <span id="code">{{ $item->size->name }}</span></p>
                                                    <p>Total Pieces: <span id="code">{{ $item->quantity->total }}
                                                            pc(s)</span></p>

                                                </div>
                                                <div class="col-sm-6">
                                                    <p>Category: <span
                                                            id="code">{{ $item->itemCategory->name }}</span></p>
                                                    </p>
                                                    <p>Active Rented Pices: <span
                                                            id="code">{{ $totActiveRentors }}</span></p>
                                                    <p>Available Pieces: <span
                                                            id="code">{{ $item->quantity->remaining }} pc(s)</span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div style="margin-top: 1rem">

                                    <a href="#" id="downloadLink" type="image/png">
                                        <img src="data:image/png;base64, {!! base64_encode(
                                            QrCode::size(160)->format('png')->generate($item->link),
                                        ) !!}" alt="QR Code">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-12" style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-sm-10" style="margin-top: 5px">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#editModal" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal">
                                                    <img src="{{ asset('assets/img/icons/edit-set.svg') }}"
                                                        alt="img" />

                                                </a>
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#plusmodal"
                                                    class="btn btn-primary">Increase</a> --}}
                                                <a href="#plusmodal" class="btn btn-success" data-bs-toggle="modal">
                                                    Increase

                                                </a>
                                                <a href="#minusmodal" class="btn btn-primary" data-bs-toggle="modal">
                                                    Decrease
                                                </a>

                                                <br>
                                                <br>

                                                <form action="{{ route('dropItem') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">

                                                    <button type="submit" class="btn btn-danger">
                                                        Drop Entirely
                                                    </button>
                                                </form>


                                            </div>
                                            <div class="col-sm-6"></div>

                                        </div>

                                    </div>
                                    <div class="col-sm-2" style="margin-top: 5px">
                                        <div class="wordset">
                                            <ul>
                                                <li>
                                                    <a href="{{ url('download_pdf', $item->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Download PDF"><img
                                                            src="{{ asset('assets/img/icons/pdf.svg') }}"
                                                            alt="img" /></a>
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

                    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Item Details</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('editItem/' . $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div style="" class="container" class="image-upload">
                                                            <input name="image" type="file" class="form-control"
                                                                onchange="loadFile(event)" placeholder="Change Photo">
                                                            <div style="margin-top:5px;padding:5px;"
                                                                class="image-uploads">
                                                                <center>
                                                                    <img style="height:fit-content;border-radius:5px;"
                                                                        id="output"
                                                                        src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                                                        alt="img">
                                                                </center>
                                                            </div>
                                                            <p style="color:red;">Upload only
                                                                jpeg,png,jpg,gif files with
                                                                Maximum
                                                                of 2(MB)</p>
                                                            <input type="hidden" name="old_image"
                                                                value="{{ $item->productImage }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <label class="col-form-label">New Name:</label>
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                        <input name="newName" type="text" class="form-control"
                                                            value="{{ $item->name }}" required>
                                                        <p style="color:red;">*Name must not be greater than 20
                                                            characters</p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="col-form-label">New Color:</label>
                                                        <select name="newColor" class="form-control">
                                                            <option value="{{ $item->color_id }}" hidden>
                                                                {{ $item->color->name }}
                                                            </option>
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color->id }}">
                                                                    {{ $color->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="col-form-label">New Category:</label>
                                                        {{-- <input name="newCategory" type="text" class="form-control"
                                                            value="{{ $item->itemCategory->name }}" required> --}}
                                                        <select name="newCategory" class="form-control">
                                                            <option value="{{ $item->item_category_id }}" hidden>
                                                                {{ $item->itemCategory->name }}
                                                            </option>
                                                            @foreach ($ItemCategs as $Categ)
                                                                <option value="{{ $Categ->id }}">
                                                                    {{ $Categ->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button name="add" type="submit" class="btn btn-submit"
                                                style="color:white;">
                                                Update
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="plusmodal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Increase Quantity</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('increaseItem') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="number" name="quantity" class="form-control"
                                                min="1" value="1">
                                            <input name="itemId" type="hidden" value="{{ $id }}">

                                        </div>
                                        <div class="modal-footer">
                                            <button name="add" type="submit" class="btn btn-submit"
                                                style="color:white;">
                                                Proceed
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="minusmodal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Decrease Quantity</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('decreaseItem') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            @if ($minToDec === 0)
                                                <h5 style="color:#bd9a62"> Nothing can be Drop here</h5>
                                        </div>
                                    @else
                                        <h5>Maximum number of Item that can be drop: <span
                                                style="color:#bd9a62">{{ $minToDec }}</span> </h5>
                                        <input type="number" name="quantity" class="form-control" min="1"
                                            max="{{ $minToDec }}" value="1">
                                        <input name="itemId" type="hidden" value="{{ $id }}">
                                </div>
                                <div class="modal-footer">
                                    <button name="add" type="submit" class="btn btn-submit"
                                        style="color:white;">
                                        Proceed
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                                @endif


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
    document.getElementById('downloadLink').addEventListener('click', function() {
        // Get the base64-encoded image data
        var imageData = "{!! base64_encode(
            QrCode::size(300)->format('png')->generate($item->link),
        ) !!}";

        // Convert base64 to binary
        var binaryData = atob(imageData);

        // Create a Uint8Array from binary data
        var arrayBuffer = new ArrayBuffer(binaryData.length);
        var uint8Array = new Uint8Array(arrayBuffer);
        for (var i = 0; i < binaryData.length; i++) {
            uint8Array[i] = binaryData.charCodeAt(i);
        }

        // Create a Blob from the Uint8Array
        var blob = new Blob([uint8Array], {
            type: 'image/png'
        });

        // Create a link element
        var downloadLink = document.createElement('a');

        // Set the href with the Blob URL
        downloadLink.href = URL.createObjectURL(blob);

        // Set the filename (optional)
        downloadLink.download = "qrcode.png";

        // Append the link to the document
        document.body.appendChild(downloadLink);

        // Trigger a click on the link
        downloadLink.click();

        // Remove the link from the document
        document.body.removeChild(downloadLink);
    });
</script>
<script type="text/javascript">
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>

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
