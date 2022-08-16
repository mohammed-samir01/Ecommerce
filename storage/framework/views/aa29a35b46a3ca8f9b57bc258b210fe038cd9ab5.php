<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ُEcommerce">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?> Dashboard</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link href="<?php echo e(asset('backend/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('backend/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body class="bg-gradient-primary">

<div class="container" style="height: 100vh">
    <?php echo $__env->yieldContent('content'); ?>
</div>


<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/sb-admin-2.min.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/layouts/admin-auth.blade.php ENDPATH**/ ?>