<div class="product-table">
    @forelse ($cart as $CartItem)
        <ul class="product-lists">
            <li>
                <div class="productimg">
                    <div class="productimgs">
                        <img src="{{ asset('storage/product_images/' . $CartItem->options->image) }}" alt="img">
                    </div>
                    <div class="productcontet">
                        <h4>{{ $CartItem->name }}
                            <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img
                                    src="{{ asset('assets/img/icons/edit-5.svg') }}" alt="img"></a>
                        </h4>
                        <div class="productlinkset">
                            <h5>{{ $CartItem->options->code }}</h5>
                        </div>
                    </div>
                </div>
            </li>
            <li><span>&#8369;</span>&nbsp;{{ number_format($CartItem->price, 2, '.', ',') }}</li>
            <li>X{{ $CartItem->qty }}</li>
            </li>
            <li>
                <a href="{{ url('cartRemove', $CartItem->rowId) }}"><img
                        src="{{ asset('assets/img/icons/delete-2.svg') }}" alt="img">
                </a>
            </li>
        </ul>
        {{-- {{ dd($CartItem) }} --}}
    @empty
        <center>
            @include('admin.partials.noProduct')
        </center>
    @endforelse
</div>
