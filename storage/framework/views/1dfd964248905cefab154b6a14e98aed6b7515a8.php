<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.customers.create')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new customer</span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('backend.customers.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email & Mobile</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($customer->user_image != ''): ?>
                                <img src="<?php echo e(asset('assets/users/'. $customer->user_image)); ?>" width="60" height="60" alt="<?php echo e($customer->full_name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/users/avatar.jpg')); ?>" width="60" height="60" alt="<?php echo e($customer->full_name); ?>">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e($customer->full_name); ?><br>
                            <strong><?php echo e($customer->username); ?></strong>
                        </td>
                        <td>
                            <?php echo e($customer->email); ?><br>
                            <?php echo e($customer->mobile); ?>

                        </td>
                        <td><?php echo e($customer->status()); ?></td>
                        <td><?php echo e($customer->created_at->format('Y-m-d')); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('admin.customers.edit', $customer->id)); ?>" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-customer-<?php echo e($customer->id); ?>').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="<?php echo e(route('admin.customers.destroy', $customer->id)); ?>" method="post" id="delete-customer-<?php echo e($customer->id); ?>" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">No customers found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            <?php echo $customers->appends(request()->all())->links(); ?>

                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/customers/index.blade.php ENDPATH**/ ?>