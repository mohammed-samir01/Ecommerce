<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Customer Addresses</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.customer_addresses.create')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Address</span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('backend.customer_addresses.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Title</th>
                    <th>Shipping Info</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Zip code</th>
                    <th>POBox</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customer_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('admin.customers.show', $address->user_id)); ?>"><?php echo e($address->user->full_name); ?></a>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.customer_addresses.show', $address->id)); ?>"><?php echo e($address->address_title); ?></a>
                            <p class="text-gray-400"><b><?php echo e($address->defaultAddress()); ?></b></p>
                        </td>
                        <td>
                            <?php echo e($address->first_name . ' ' . $address->last_name); ?>

                            <p class="text-gray-400"><?php echo e($address->email); ?><br/><?php echo e($address->mobile); ?></p>
                        </td>
                        <td><?php echo e($address->country->name . ' - ' . $address->state->name .' - ' . $address->city->name); ?></td>
                        <td><?php echo e($address->address); ?></td>
                        <td><?php echo e($address->zip_code); ?></td>
                        <td><?php echo e($address->po_box); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('admin.customer_addresses.edit', $address->id)); ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this record?') ) { document.getElementById('delete-address-<?php echo e($address->id); ?>').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="<?php echo e(route('admin.customer_addresses.destroy', $address->id)); ?>" method="post" id="delete-address-<?php echo e($address->id); ?>" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center">No addresses found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <div class="float-right">
                                <?php echo $customer_addresses->appends(request()->all())->links(); ?>

                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/customer_addresses/index.blade.php ENDPATH**/ ?>