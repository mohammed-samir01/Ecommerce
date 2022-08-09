<div>
    <h2 class="h5 text-uppercase mb-4">Related products</h2>
    <div class="row">
        @forelse($relatedProducts as $relatedProduct)
            <div class="col-lg-3 col-sm-6">
                <div class="product text-center skel-loader">
                    <div class="d-block mb-3 position-relative">
                        <a class="d-block" href="{{ route('frontend.product', $relatedProduct->slug) }}">
                            <img class="img-fluid w-100" src="{{ asset('assets/products/'. $relatedProduct->firstMedia->file_name) }}" alt="{{ $relatedProduct->name }}">
                        </a>
                        <div class="product-overlay">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item m-0 p-0">
                                    <a wire:click.prevent="addToWishList('{{ $relatedProduct->id }}')" class="btn btn-sm btn-outline-dark">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item m-0 p-0">
                                    <a wire:click.prevent="addToCart('{{ $relatedProduct->id }}')" class="btn btn-sm btn-dark">
                                        Add to cart
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a
                                        wire:click.prevent="$emit('showProductModalAction', '{{ $relatedProduct->slug }}')"
                                        class="btn btn-sm btn-outline-dark"
                                        data-target="#productView"
                                        data-toggle="modal">
                                        <i class="fas fa-expand"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h6><a class="reset-anchor" href="{{ route('frontend.product', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a></h6>
                    <p class="small text-muted">${{ $relatedProduct->price }}</p>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
