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
                                        <a href="#editModal" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />

                                        </a>

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
                                    <form action="{{ url('editItem/' . $item->id) }}" method="POST">

                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6">yow</div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <label class="col-form-label">New Name:</label>
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                        <input name="newName" type="text" class="form-control"
                                                            value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="col-form-label">New Color:</label>
                                                        <select name="newColor" class="form-control">
                                                            <option value="{{ $item->color }}" hidden>
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
                                                        <input name="newCateg" type="text" class="form-control"
                                                            value="{{ $item->itemCategory->name }}" required>
                                                    </div>

                                                    <center>or</center>

                                                    <div class="mb-2">
                                                        <label class="col-form-label">Change Quantity:</label>
                                                        <input name="newQuan" type="text" class="form-control"
                                                            value="{{ $item->quantity->total }}" required>
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
