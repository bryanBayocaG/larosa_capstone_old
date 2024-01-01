<div>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Item Category list</h4>
                <h6>View/Search Item Categroy</h6>
            </div>
            <div class="page-btn">
                <a href="addcategory.php" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addItemCateg">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img" />
                    Item Category
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
                                <th>Item Category Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Item Category Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($ItemCateg as $icateg)
                                <tr>
                                    <td>{{ $icateg->name }}</td>
                                    <td>
                                        <div style="width: 300px;">
                                            <p style="white-space: pre-line">{{ $icateg->description }}</p>
                                        </div>
                                    </td>
                                    <td>

                                        <a href="#editModal{{ $icateg->id }}" data-bs-toggle="modal">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a href="{{ url('delete_Icategory2', $icateg->id) }}"
                                            onclick="confirmation(event)">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{ $icateg->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Item Category
                                                    Details</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('category2/' . $icateg->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="col-form-label">New Name:</label>
                                                            <input type="hidden" name="id"
                                                                value="{{ $icateg->id }}">
                                                            <input name="NewCategName" type="text"
                                                                class="form-control" value="{{ $icateg->name }}"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="col-form-label">New Description:</label>
                                                            <textarea name="NewDescription" class="form-control" rows="5">{{ $icateg->description }}</textarea>
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
    <div class="modal fade" id="addItemCateg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Item Category
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form wire:submit.prevent="create">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">New Item Category:</label>
                            <input wire:model.defer="name"{{-- name="name" --}} type="text" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description:</label>

                            <textarea wire:model.defer="description"{{-- name="description" --}} class="form-control" cols="30" rows="6"></textarea>
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
</div>
