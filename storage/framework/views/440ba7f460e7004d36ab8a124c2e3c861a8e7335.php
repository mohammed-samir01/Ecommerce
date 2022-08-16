<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new product</span>
                </a>
            </div>
        </div>

        <?php echo $__env->make('backend.products.filter.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Feature</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($product->firstMedia): ?>
                                <img src="<?php echo e(asset('assets/products/' . $product->firstMedia->file_name)); ?>" width="60" height="60" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/no-image.png')); ?>" width="60" height="60" alt="<?php echo e($product->name); ?>">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($product->name); ?></td>
                        <td><?php echo e($product->featured()); ?></td>
                        <td><?php echo e($product->quantity); ?></td>
                        <td><?php echo e($product->price); ?></td>
                        <td><?php echo e($product->tags->pluck('name')->join(', ')); ?></td>
                        <td><?php echo e($product->status()); ?></td>
                        <td><?php echo e($product->created_at); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-<?php echo e($product->id); ?>').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="<?php echo e(route('admin.products.destroy', $product->id)); ?>" method="post" id="delete-product-<?php echo e($product->id); ?>" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center">No products found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="float-right">
                            <?php echo $products->appends(request()->all())->links(); ?>

                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/products/index.blade.php ENDPATH**/ ?>