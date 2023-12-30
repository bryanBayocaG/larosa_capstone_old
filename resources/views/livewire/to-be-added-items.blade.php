<div class="row">
    @foreach ($cartItem as $item)      
    <div class="col-lg-2 col-sm-4 d-flex ">
        <a href="{{ url('addProductSet/' . $product->id) }}">
            <div class="productset flex-fill">
                <div class="productsetimg" style="">
                    <img src="{{ asset('storage/product_images/' . $product->productImage) }}"
                        alt="img">
                </div>
                <div class="productsetcontent">
                    <h6>{{ $product->name }}</h6>
                    <p>{{ $product->category->name }}</p>
                </div>
            </div>
        </a>
    </div>
            
    @endforeach
    <div class="col-lg-2 col-sm-4 d-flex ">
        <div class="page-header">
            <div class="page-btn">
                <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#registerProd">
                    <img src="{{ asset('assets/img/icons/product.svg') }}" class="me-1" alt="img" />
                    Register an Item
                </a>
            </div>
        </div>
    </div>

</div>
