<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!-- Lightbox-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/lightbox2/css/lightbox.min.css')); ?>">
    <!-- Range slider-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/nouislider/nouislider.min.css')); ?>">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/bootstrap-select/css/bootstrap-select.min.css')); ?>">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/owl.carousel2/assets/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/owl.carousel2/assets/owl.theme.default.css')); ?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.default.css')); ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/custom.css')); ?>">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <?php echo \Livewire\Livewire::styles(); ?>

    <?php echo $__env->yieldContent('style'); ?>

</head>
<body>
    <div id="app" class="page-holder <?php echo e(request()->routeIs('frontend.product') ? 'bg-light' : null); ?>">

        <?php echo $__env->make('partial.frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php echo $__env->make('partial.frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>


    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('frontend.product-modal-shared', [])->html();
} elseif ($_instance->childHasBeenRendered('QV9Cxsn')) {
    $componentId = $_instance->getRenderedChildComponentId('QV9Cxsn');
    $componentTag = $_instance->getRenderedChildComponentTagName('QV9Cxsn');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('QV9Cxsn');
} else {
    $response = \Livewire\Livewire::mount('frontend.product-modal-shared', []);
    $html = $response->html();
    $_instance->logRenderedChild('QV9Cxsn', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <!-- JavaScript files-->
    <script src="<?php echo e(asset('frontend/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/lightbox2/js/lightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/nouislider/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/bootstrap-select/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/owl.carousel2/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/front.js')); ?>"></script>

    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'livewire-alert::components.scripts','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-alert::scripts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/layouts/app.blade.php ENDPATH**/ ?>