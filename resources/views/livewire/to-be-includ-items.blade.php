<div>
    <input wire:model.live="search" placeholder="Search Item..." class="form-control" style="width: 50%;">
    <div style="display: flex; justify-content: flex-end; margin-bottom:5px">
        <p style="margin-right: 5px;">Filter By: </p>
        <select id="selectFilter" wire:model.live="color" style="margin-right: 2px">
            <option value="0">Any Color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
        <select id="selectFilter" wire:model.live="category">
            <option value="0">Any Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        @forelse ($items as $item)
            <div class="col-lg-3 col-sm-4 d-flex ">
                <div class="productset flex-fill">
                    <div class="productsetimg">
                        <img src="{{ asset('storage/item_images/' . $item->productImage) }}" alt="img">
                        <h6>{{ $item->item_code }}</h6>
                    </div>
                    <div class="productsetcontent">
                        <h6>{{ $item->name }}</h6>
                        <p>Color: {{ $item->color->name }} <br>
                            Quantity: {{ $item->quantity->remaining }}/{{ $item->quantity->total }}<br>
                            Category: {{ $item->itemCategory->name }}
                        </p>
                        @if ($cart->where('id', $item->id)->count())
                            <a href="javascript:void(0);" class="btn btn-remove">
                                Included
                            </a>
                        @else
                            <form wire:submit.prevent='include({{ $item->id }})' method="POST">
                                @csrf
                                {{-- <input type="hidden" name="item_id" value="{{ $item->id }}"> --}}
                                <input type="hidden" wire:model='kulay'{{-- name="color" --}}
                                    value="{{ $item->color->name }}">
                                <input type="hidden" wire:ignore name="dami"
                                    value="{{ $item->quantity->remaining }}">
                                <button type="submit" class="btn btn-adds">
                                    Include
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <center>
                <h2>No product</li>
            </center>
        @endforelse

    </div>
</div>
