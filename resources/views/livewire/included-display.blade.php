<div class="row">
    @forelse ($includedItem as $item)
        <div class="col-lg-3 col-sm-4 d-flex ">
            <div class="productset flex-fill">
                <div class="productsetimg">
                    <img src="{{ asset('storage/item_images/' . $item->options->image) }}" alt="img">
                    <h6>{{ $item->options->code }}</h6>
                </div>
                <div class="productsetcontent">
                    <h6>{{ $item->name }}</h6>
                    <p>Quantity: {{ $item->options->remain }}/{{ $item->options->total }}
                    </p>
                    <a class="btn btn-danger" href="{{ url('inludeItemRemove', $item->rowId) }}">
                        REMOVE
                    </a>
                </div>
            </div>
        </div>
    @empty
        <center>
            <h6>No included yet</h6>
        </center>
    @endforelse

</div>
