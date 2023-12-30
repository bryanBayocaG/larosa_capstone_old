<div class="col-sm-12">
    @if ($includedItems->count())
        <div class="row">
            <div class="col-sm-10"></div>
            <div class="col-sm-2">
                <button name="add" type="submit" class="btn btn-primary" style="color:white;">
                    Register
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-9"></div>
            <div class="col-sm-3">
                <h6>Inclue item first to register</h6>
            </div>
        </div>
    @endif

</div>
