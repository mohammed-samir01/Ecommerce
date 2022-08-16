<?php if(session()->has('message')): ?>
    <div class="alert alert-<?php echo e(session()->get('alert-type')); ?> alert-dismissible fade show" role="alert" id="alert-message">
        <?php echo e(session()->get('message')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/partial/backend/flash.blade.php ENDPATH**/ ?>