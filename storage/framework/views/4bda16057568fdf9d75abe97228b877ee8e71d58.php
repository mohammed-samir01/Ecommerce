<div class="card-body">
    <form action="<?php echo e(route('admin.customer_addresses.index')); ?>" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="<?php echo e(old('keyword', request()->input('keyword'))); ?>" class="form-control" placeholder="Search here">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="1" <?php echo e(old('status', request()->input('status')) == '1' ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e(old('status', request()->input('status')) == '0' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value="">---</option>
                        <option value="id" <?php echo e(old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : ''); ?>>ID</option>
                        <option value="name" <?php echo e(old('sort_by', request()->input('sort_by')) == 'name' ? 'selected' : ''); ?>>Name</option>
                        <option value="created_at" <?php echo e(old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : ''); ?>>Created at</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" <?php echo e(old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : ''); ?>>Ascending</option>
                        <option value="desc" <?php echo e(old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : ''); ?>>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" <?php echo e(old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : ''); ?>>10</option>
                        <option value="20" <?php echo e(old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : ''); ?>>20</option>
                        <option value="50" <?php echo e(old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : ''); ?>>50</option>
                        <option value="100" <?php echo e(old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : ''); ?>>100</option>
                    </select>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-link">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/backend/customer_addresses/filter/filter.blade.php ENDPATH**/ ?>