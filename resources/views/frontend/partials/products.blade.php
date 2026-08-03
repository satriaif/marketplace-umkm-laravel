<div class="row">

   @foreach($products as $product)

   <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

      <div class="card product-card h-100 border-0">

         <div class="overflow-hidden rounded-top-4">

            <img src="{{ asset('storage/products/'.$product->image) }}" class="card-img-top product-image">

         </div>
         <div class="card-body d-flex flex-column">

            <span class="badge bg-light text-primary align-self-start mb-2">
               {{ $product->category->category_name }}
            </span>

            <h5 class="fw-semibold product-title mb-2">
               {{ $product->product_name }}
            </h5>

            <small class="text-muted mb-2">
               <i class="bi bi-shop"></i>
               {{ $product->seller->seller_name }}
            </small>

            <div class="mt-auto">

               <h5 class="text-primary fw-bold mb-3">
                  Rp {{ number_format($product->price,0,',','.') }}
               </h5>

               <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary w-100 rounded-pill">

                  Detail Produk

               </a>

            </div>

         </div>

      </div>

   </div>

   @endforeach

</div>