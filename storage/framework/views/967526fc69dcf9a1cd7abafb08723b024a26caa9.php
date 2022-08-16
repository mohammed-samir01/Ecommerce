<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Coupons</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.product_coupons.create')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new coupon</span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('backend.product_coupons.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Value</th>
                    <th>Use times</th>
                    <th>Validity date</th>
                    <th>Greater than</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($coupon->code); ?></td>
                        <td><?php echo e($coupon->value); ?> <?php echo e($coupon->type == 'fixed' ? '$' : '%'); ?></td>
                        <td><?php echo e($coupon->used_times . ' / ' . $coupon->use_times); ?></td>
                        <td><?php echo e($coupon->start_date != '' ? $coupon->start_date->format('Y-m-d') . ' - ' . $coupon->expire_date->format('Y-m-d') : '-'); ?></td>
                        <td><?php echo e($coupon->greater_than ?? '-'); ?></td>
                        <td><?php echo e($coupon->status()); ?></td>
                        <td><?php echo e($coupon->created_at->format('Y-m-d h:i a')); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('admin.product_coupons.edit', $coupon->id)); ?>" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-coupon-<?php echo e($coupon->id); ?>').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="<?php echo e(route('admin.product_coupons.destroy', $coupon->id)); ?>" method="post" id="delete-product-coupon-<?php echo e($coupon->id); ?>" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">No coupons found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="float-right">
                            <?php echo $coupons->appends(request()->all())->links(); ?>

                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/product_coupons/index.blade.php ENDPATH**/ ?>