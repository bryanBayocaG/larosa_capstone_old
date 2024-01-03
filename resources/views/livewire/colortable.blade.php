<div>

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Color list</h4>
                <h6>View/Search product Color</h6>
            </div>
            <div class="page-btn">
                <a href="addcategory.php" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addColor">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img" />
                    Add Color
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
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
                                <th>Color Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Colors as $color)
                                <tr>
                                    <td>{{ $color->name }}</td>
                                    <td>
                                        <a href="#color{{ $color->id }}" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a href="{{ url('delete_color', $color->id) }}" onclick="confirmation(event)">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="color{{ $color->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Color Details</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('color/' . $color->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="col-form-label">New Name:</label>
                                                            <input type="hidden" name="id"
                                                                value="{{ $color->id }}">
                                                            <input name="NewCategName" type="text"
                                                                class="form-control" value="{{ $color->name }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button name="add" type="submit" class="btn btn-primary"
                                                            style="color:white;">
                                                            Update
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Color
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form {{-- wire:submit="create" --}} action="{{ route('addColor') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">New Color:</label>
                            <input {{-- wire:model.defer="name" --}}name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button name="add" type="submit" class="btn btn-primary" style="color:white;">
                            Add
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('livewire:load', function() {
            // Reinitialize DataTables here
            $('#datatable').DataTable();
        });
    </script>
</div>
