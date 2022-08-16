<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Payment methods</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.payment_methods.create')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Payment method</span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('backend.payment_methods.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Sandbox</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($payment_method->name); ?></td>
                        <td><?php echo e($payment_method->code); ?></a></td>
                        <td><?php echo e($payment_method->sandbox()); ?></a></td>
                        <td><?php echo e($payment_method->status()); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('admin.payment_methods.edit', $payment_method->id)); ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this record?') ) { document.getElementById('delete-payment-method-<?php echo e($payment_method->id); ?>').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                            <form action="<?php echo e(route('admin.payment_methods.destroy', $payment_method->id)); ?>" method="post" id="delete-payment-method-<?php echo e($payment_method->id); ?>" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">No payment methods found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            <?php echo $payment_methods->appends(request()->input())->links(); ?>

                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/payment_methods/index.blade.php ENDPATH**/ ?>