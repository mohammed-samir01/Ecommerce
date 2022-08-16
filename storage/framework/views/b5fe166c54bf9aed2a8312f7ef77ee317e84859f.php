<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendor/datepicker/themes/classic.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/vendor/datepicker/themes/classic.date.css')); ?>">
    <style>
        .picker__select--month, .picker__select--year {
            padding: 0 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create coupon</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.product_coupons.index')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Coupons</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="<?php echo e(route('admin.product_coupons.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="code" value="<?php echo e(old('code')); ?>" class="form-control">
                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="">---</option>
                            <option value="fixed" <?php echo e(old('type') == 'fixed' ? 'selected' : null); ?>>Fixed</option>
                            <option value="percentage" <?php echo e(old('type') == 'percentage' ? 'selected' : null); ?>>Percentage</option>
                        </select>
                        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" value="<?php echo e(old('value')); ?>" class="form-control">
                            <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="use_times">Use times</label>
                            <input type="number" name="use_times" value="<?php echo e(old('use_times')); ?>" class="form-control">
                            <?php $__errorArgs = ['use_times'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="start_date">Start date</label>
                            <input type="text" name="start_date" id="start_date" value="<?php echo e(old('start_date')); ?>" class="form-control">
                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="expire_date">Expire date</label>
                            <input type="text" name="expire_date" id="expire_date" value="<?php echo e(old('expire_date')); ?>" class="form-control">
                            <?php $__errorArgs = ['expire_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="greater_than">Greater than</label>
                            <input type="number" name="greater_than" value="<?php echo e(old('greater_than')); ?>" class="form-control">
                            <?php $__errorArgs = ['greater_than'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo e(old('status') == '1' ? 'selected' : null); ?>>Active</option>
                                <option value="0" <?php echo e(old('status') == '0' ? 'selected' : null); ?>>Inactive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backend/vendor/datepicker/picker.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/vendor/datepicker/picker.date.js')); ?>"></script>
    <script>
        $(function(){
            $('#code').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $('#start_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });
            var startdate = $('#start_date').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            $('#start_date').change(function() {
                selected_ci_date ="";
                selected_ci_date = $('#start_date').val();
                if (selected_ci_date != null)   {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate()+1);
                    enddate.set('min', min_codate);
                }
            });

            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min : new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/product_coupons/create.blade.php ENDPATH**/ ?>