<?php $__env->startSection('content'); ?>

    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center"
             style="background: url(<?php echo e(asset('assets/sliders/hero-banner-alt.jpg')); ?>)">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                    <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-dark"
                                                                                    href="<?php echo e(route('frontend.shop')); ?>">Browse
                        collections</a>
                </div>
            </div>
        </div>
    </section>
    <!-- CATEGORIES SECTION-->
    <section class="pt-5">
        <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Carefully created collections</p>
            <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
        </header>

        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <a class="category-item" href="<?php echo e(route('frontend.shop', $product_categories[0]->slug)); ?>">
                    <img class="img-fluid" src="<?php echo e(asset('assets/product_categories/cat-img-1.jpg')); ?>" alt="">
                    <strong class="category-item-title">Clothes</strong>
                </a>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <a class="category-item mb-4" href="<?php echo e(route('frontend.shop', $product_categories[1]->slug)); ?>">
                    <img class="img-fluid" src="<?php echo e(asset('assets/product_categories/cat-img-2.jpg')); ?>" alt="">
                    <strong class="category-item-title">Shoes</strong>
                </a>
                <a class="category-item" href="<?php echo e(route('frontend.shop', $product_categories[2]->slug)); ?>">
                    <img class="img-fluid" src="<?php echo e(asset('assets/product_categories/cat-img-3.jpg')); ?>" alt="">
                    <strong class="category-item-title">Watches</strong>
                </a>
            </div>
            <div class="col-md-4">
                <a class="category-item" href="<?php echo e(route('frontend.shop', $product_categories[3]->slug)); ?>">
                    <img class="img-fluid" src="<?php echo e(asset('assets/product_categories/cat-img-4.jpg')); ?>" alt="">
                    <strong class="category-item-title">Electronics</strong>
                </a>
            </div>
        </div>
    </section>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('frontend.featured-product', [])->html();
} elseif ($_instance->childHasBeenRendered('uOLsyap')) {
    $componentId = $_instance->getRenderedChildComponentId('uOLsyap');
    $componentTag = $_instance->getRenderedChildComponentTagName('uOLsyap');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('uOLsyap');
} else {
    $response = \Livewire\Livewire::mount('frontend.featured-product', []);
    $html = $response->html();
    $_instance->logRenderedChild('uOLsyap', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <!-- SERVICES-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#delivery-time-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">Free shipping</h6>
                                <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#helpline-24h-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                                <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#label-tag-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">Festival offer</h6>
                                <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- NEWSLETTER-->
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <h5 class="text-uppercase">Let's be friends!</h5>
                    <p class="text-small text-muted mb-0">Nisi nisi tempor consequat laboris nisi.</p>
                </div>
                <div class="col-lg-6">
                    <form action="#">
                        <div class="input-group flex-column flex-sm-row mb-3">
                            <input class="form-control form-control-lg py-3" type="email"
                                   placeholder="Enter your email address" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark btn-block" id="button-addon2" type="submit">Subscribe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/frontend/index.blade.php ENDPATH**/ ?>