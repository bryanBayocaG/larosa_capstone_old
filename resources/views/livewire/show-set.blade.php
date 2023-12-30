<div>
    <input wire:model.live="search" placeholder="Search Item..." class="form-control"
        style="margin-bottom: 5px; width: 50%; display: flex; justify-content: flex-end;">

    <div class="row ">
        @forelse ($setss as $set)
            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="productset flex-fill">
                    <div class="productsetimg">
                        <img src="{{ asset('storage/product_images/' . $set->productImage) }}" alt="img">
                        <h6>{{ $set->set_code }}</h6>
                    </div>
                    <div class="productsetcontent">
                        <h5>{{ $set->name }}</h5>
                        <a href="javascript:void(0);" class="btn btn-adds" data-product-id="{{ $set->id }}"
                            data-bs-toggle="modal" data-bs-target="#addToCart{{ $set->id }}">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addToCart{{ $set->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <p>Product Code: <span id="topcode">{{ $set->set_code }}</span></p>
                                <p>Available Quantity: <span id="topcode">{{ $set->quantity }}</span></p>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('cart.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="{{ asset('storage/product_images/' . $set->productImage) }}"
                                            alt="Variant Image">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <div class="mb-2">
                                                <input type="hidden" name="setID" value="{{ $set->id }}">
                                                <label for="colorInput" class="form-label">Color</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $set->color->name }}" name="color" readonly>
                                            </div>
                                            <div class="mb-2">

                                                <label for="sizeInput" class="form-label">Category</label>
                                                <input type="text" class="form-control" id="sizeInput"
                                                    value="{{ $set->category->name }}" name="category" readonly>
                                            </div>

                                            <div class="mb-2">
                                                <label for="pricing" class="form-label">Quantity</label>
                                                <input type="number" min="1" max="{{ $set->quantity }}"
                                                    class="form-control" id="pricing" name="quantity" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="pricing" class="form-label">Pricing</label>
                                                <input type="text" class="form-control" id="pricing" name="price"
                                                    required>
                                            </div>
                                            <input type="hidden" class="form-control" id="idInput" name="var_id">
                                            <input type="hidden" class="form-control" id="codeInput" name="code">
                                            <input type="hidden" class="form-control" id="productInput" name="product">
                                            <input type="hidden" class="form-control" id="imgInput" name="imgname">
                                        </div>
                                        {{-- @if ($cart->where('id', $set->id && 'qty', $set->quantity)->count())
                                            <h1>no</h1>
                                        @else
                                            <div class="col-lg-12">
                                                <button id="addme" class="btn form-control" type="submit">Add to
                                                    Cart</button>
                                            </div>
                                        @endif --}}
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


</div>
