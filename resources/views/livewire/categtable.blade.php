<div>
    <div class="table-responsive">
        <table id="datatable" class="table datanew">
            <thead>
                <tr>
                    <th>Set Category Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Set Category Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($Categ as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div style="width: 300px;">
                                <p style="white-space: pre-line">{{ $category->description }}</p>
                            </div>
                        </td>
                        <td>

                            <a href="#editModal{{ $category->id }}" data-bs-toggle="modal">
                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                            </a>
                            <a href="{{ url('delete_category', $category->id) }}" onclick="confirmation(event)">
                                <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $category->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Set Category</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('category/' . $category->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="col-form-label">New Name:</label>
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <input name="NewCategName" type="text" class="form-control"
                                                    value="{{ $category->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">New Description:</label>
                                                <textarea name="NewDescription" class="form-control" rows="5">{{ $category->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button name="add" type="submit" class="btn btn-primary"
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
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- edit modal --}}
    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add Set Category
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('addSetCategory') }}" method="POST">
                    {{-- <form wire:submit.prevent="create"> --}}
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">New Set Category:</label>
                            <input {{-- wire:model.defer="name" --}}name="name" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description:</label>

                            <textarea {{-- wire:model.defer="description" --}}name="description" class="form-control" cols="30" rows="6"></textarea>
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
{{-- modal --}}
