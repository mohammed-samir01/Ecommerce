<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Address</h6>
            <div class="ml-auto">
                <a href="<?php echo e(route('admin.customer_addresses.index')); ?>" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Customer Addresses</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="<?php echo e(route('admin.customer_addresses.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="user_id">Customer</label>
                            <input type="text" class="form-control typeahead" name="customer_name" id="customer_name" value="<?php echo e(old('customer_name', request()->input('customer_name'))); ?>" placeholder="Start typing something to search customer..." autocomplete="off">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo e(old('user_id', request()->input('user_id'))); ?>" readonly>
                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address_title">Address title</label>
                            <input type="text" name="address_title" value="<?php echo e(old('address_title')); ?>" class="form-control">
                            <?php $__errorArgs = ['address_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="default_address">Default address</label>
                            <select name="default_address" class="form-control">
                                <option value="0" <?php echo e(old('default_address') == '0' ? 'selected' : null); ?>>No</option>
                                <option value="1" <?php echo e(old('default_address') == '1' ? 'selected' : null); ?>>Yes</option>
                            </select>
                            <?php $__errorArgs = ['default_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" class="form-control">
                            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" class="form-control">
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?php echo e(old('email')); ?>" class="form-control">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control">
                            <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value=""> --- </option>
                                <?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($country->id); ?>" <?php echo e(old('country_id') == $country->id ? 'selected' : null); ?>><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control">
                            </select>
                            <?php $__errorArgs = ['state_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                            </select>
                            <?php $__errorArgs = ['city_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="<?php echo e(old('address')); ?>" class="form-control">
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address2">Address 2</label>
                            <input type="text" name="address2" value="<?php echo e(old('address2')); ?>" class="form-control">
                            <?php $__errorArgs = ['address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="zip_code">ZIP code</label>
                            <input type="text" name="zip_code" value="<?php echo e(old('zip_code')); ?>" class="form-control">
                            <?php $__errorArgs = ['zip_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="po_box">P.O.Box</label>
                            <input type="text" name="po_box" value="<?php echo e(old('po_box')); ?>" class="form-control">
                            <?php $__errorArgs = ['po_box'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Address</button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backend/vendor/typeahead/bootstrap3-typeahead.min.js')); ?>"></script>
    <script>
        $(function () {
            $(".typeahead").typeahead({
                autoSelect: true,
                minLength: 3,
                delay: 400,
                displayText: function (item) { return item.full_name + ' - ' + item.email; },
                source: function (query, process) {
                    return $.get("<?php echo e(route('admin.customers.get_customers')); ?>", { 'query': query }, function (data) {
                        return process(data);
                    });
                },
                afterSelect: function (data) {
                    $('#user_id').val(data.id);
                }
            });

            populateStates();
            populateCities();

            $("#country_id").change(function () {
                populateStates();
                populateCities();
                return false;
            });

            $("#state_id").change(function () {
                populateCities();
                return false;
            });


            function populateStates()
            {
                let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : '<?php echo e(old('country_id')); ?>';
                $.get("<?php echo e(route('admin.states.get_states')); ?>", {country_id: countryIdVal}, function (data) {
                    $('option', $("#state_id")).remove();
                    $("#state_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '<?php echo e(old('state_id')); ?>' ? "selected" : "";
                        $("#state_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

            function populateCities()
            {
                let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : '<?php echo e(old('state_id')); ?>';
                $.get("<?php echo e(route('admin.cities.get_cities')); ?>", {state_id: stateIdVal}, function (data) {
                    $('option', $("#city_id")).remove();
                    $("#city_id").append($('<option></option>').val('').html(' --- '));
                    $.each(data, function (val, text) {
                        let selectedVal = text.id == '<?php echo e(old('city_id')); ?>' ? "selected" : "";
                        $("#city_id").append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                }, "json");
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/customer_addresses/create.blade.php ENDPATH**/ ?>