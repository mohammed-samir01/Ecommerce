<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ُEcommerce Application">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Hooksha">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo e(assert('favicon.ico')); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?>Dashboard</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('backend/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('backend/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo e(asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('backend/vendor/summernote/summernote-bs4.min.css')); ?>">


    <?php echo $__env->yieldContent('style'); ?>

</head>
<body id="page-top">

<div id="app">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php echo $__env->make('partial.backend.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php echo $__env->make('partial.backend.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php echo $__env->make('partial.backend.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>

                </div>

            </div>

            <?php echo $__env->make('partial.backend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php echo $__env->make('partial.backend.model', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>


<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset('backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo e(asset('backend/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo e(asset('backend/js/sb-admin-2.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/bootstrap-fileinput/themes/bs5/theme.min.js')); ?>"></script>

<script src="<?php echo e(asset('backend/vendor/summernote/summernote-bs4.min.js')); ?>"></script>


<?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/layouts/admin.blade.php ENDPATH**/ ?>