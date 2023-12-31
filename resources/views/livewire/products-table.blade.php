<div>

    <input wire:model.live="search" placeholder="Search Item..." class="form-control"
        style="margin-bottom: 5px; width: 50%; display: flex; justify-content: flex-end;">

    <div class="row">
        @forelse ($items as $item)
            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="productset flex-fill">
                    <div class="productsetimg">
                        <img src="{{ asset('storage/item_images/' . $item->productImage) }}" alt="img">
                        <h6>Qty: {{ $item->quantity->remaining }}</h6>
                    </div>
                    <div class="productsetcontent">
                        <h5>{{ $item->name }}</h5>
                        @if ($item->quantity->remaining === 0)
                            <h6>Out of stock</h6>
                        @else
                            <a href="javascript:void(0);" class="btn btn-adds" data-product-id="{{ $item->id }}"
                                data-bs-toggle="modal" data-bs-target="#addToCart{{ $item->id }}">
                                Add to Cart
                            </a>
                            {{-- <a href="javascript:void(0);" class="btn btn-adds" data-product-id="{{ $item->id }}"
                                data-bs-toggle="modal" data-bs-target="#addTocart"
                                data-variant-details='{
                            "id":"{{ $item->id }}",
                            "code": "{{ $item->item_code }}",
                            "quantity": "{{ $item->quantity->remaining }}",
                            "color": {"name": "{{ $item->color->name }}"},
                            
                            "product": {"name": "{{ $item->name }}"},
                            "imagename": "{{ $item->productImage }}",
                            "image": "{{ asset('storage/item_images/' . $item->productImage) }}" }'>
                                Add to Cart
                            </a> --}}
                        @endif

                    </div>
                </div>
            </div>

            <div class="modal fade" id="addToCart{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="modal-title" id="variantDetailsModalLabel">Add <span id="productName">
                                        </span> to
                                        Cart</h5>
                                </div>
                                <p>Product Code: <span id="topcode">{{ $item->item_code }}</span></p>
                                <p>Available Quantity: <span id="topcode">{{ $item->quantity->remaining }}</span></p>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('cart.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="{{ asset('storage/item_images/' . $item->productImage) }}"
                                            alt="Variant Image">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <div class="mb-2">
                                                <label for="colorInput" class="form-label">Color</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->color->name }}" name="color" readonly>
                                            </div>
                                            <div class="mb-2">
                                                <label for="sizeInput" class="form-label">Category</label>
                                                <input type="text" class="form-control" id="sizeInput"
                                                    value="{{ $item->itemCategory->name }}" name="category" readonly>
                                            </div>
                                            <div class="mb-2">
                                                <label for="pricing" class="form-label">Quantity</label>
                                                <input type="number" min="1"
                                                    max="{{ $item->quantity->remaining }}" class="form-control"
                                                    id="pricing" name="quantity" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="pricing" class="form-label">Price</label>
                                                <input type="text" class="form-control"
                                                    pattern="[0-9]+(\.[0-9]{1,2})?" id="priceng" name="price"
                                                    required>
                                            </div>
                                            <input type="hidden" class="form-control" id="idInput" name="var_id">
                                            <input type="hidden" class="form-control" id="codeInput" name="code">
                                            <input type="hidden" class="form-control" id="productInput" name="product">
                                            <input type="hidden" class="form-control" id="imgInput" name="imgname">
                                        </div>
                                        <div class="col-lg-12">
                                            <button id="addme" class="btn form-control" type="submit">Add to
                                                Cart</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <center>
                <h2>No product</li>
            </center>
        @endforelse
    </div>
    {{-- <h1>To be follow</h1> --}}

</div>
