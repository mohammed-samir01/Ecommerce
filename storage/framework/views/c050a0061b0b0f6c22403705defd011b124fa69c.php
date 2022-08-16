<div wire:ignore>
    <!-- TRENDING PRODUCTS-->
    <section class="py-5">
        <header>
            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
        </header>
        <div class="row">

            <?php $__empty_1 = true; $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featuredProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div>
                            <a class="d-block" href="<?php echo e(route('frontend.product', $featuredProduct->slug)); ?>">
                                <img class="img-fluid w-100" src="<?php echo e(asset('assets/products/' . $featuredProduct->firstMedia->file_name)); ?>" alt="<?php echo e($featuredProduct->name); ?>">
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0">
                                        <a wire:click.prevent="addToWishList(<?php echo e($featuredProduct->id); ?>)" class="btn btn-sm btn-outline-dark">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item m-0 p-0">
                                        <a wire:click.prevent="addToCart(<?php echo e($featuredProduct->id); ?>)" class="btn btn-sm btn-dark text-light">Add to cart</a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a
                                            wire:click.prevent="$emit('showProductModalAction', '<?php echo e($featuredProduct->slug); ?>')"
                                            class="btn btn-sm btn-outline-dark"
                                            data-target="#productView"
                                            data-toggle="modal">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6>
                            <a class="reset-anchor" href="<?php echo e(route('frontend.product', $featuredProduct->slug)); ?>">
                                <?php echo e($featuredProduct->name); ?>

                            </a>
                        </h6>
                        <p class="small text-muted">$<?php echo e($featuredProduct->price); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>

        </div>
    </section>
</div>
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/livewire/frontend/featured-product.blade.php ENDPATH**/ ?>