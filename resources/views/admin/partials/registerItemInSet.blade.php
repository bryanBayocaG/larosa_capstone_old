<div class="modal fade bd-example-modal-lg" id="registerProd" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Register an Item inset
            </h5>
            <a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                &times;
            </a>
        </div>
        <form action="{{ route('addItemInSet') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label> Item Image</label>
                            <div style="" class="container" class="image-upload">
                                <input name="image" type="file" class="form-control"
                                    onchange="loadFile2(event)">
                                <div style="margin-top:5px;padding:5px;" class="image-uploads">
                                    <center>
                                        <img style="height:fit-content;border-radius:5px;" id="output2"
                                            src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    </center>
                                </div>
                            </div>
                        </div>
                        <p style="color:red;margin-top:-20px;">Upload only jpeg,png,jpg,gif files with Maximum
                            of 2(MB)</p>
                    </div>
                    <div class="col-sm-7">
                        <div class="mb-1">
                            <label class="col-form-label">Item Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label">Item Category</label>
                            <select class="form-control" name="category" class="select" required>
                                <option value="" hidden>Choose Category</option>
                                @foreach ($icateg as $icateg)
                                    <option value="{{ $icateg->id }}"> {{ $icateg->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label">Color</label>
                            <select class="form-control" name="Color" class="select" required>
                                <option value="" hidden>Choose Color</option>
                                @foreach ($colorses as $col)
                                    <option value="{{ $col->id }}"> {{ $col->name }} </option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label">Item Quantity</label>
                            <input name="quantity" type="number" min="1" class="form-control" required>
                        </div>
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