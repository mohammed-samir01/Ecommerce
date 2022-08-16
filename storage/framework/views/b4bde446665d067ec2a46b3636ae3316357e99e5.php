<?php
    $current_page = \Route::currentRouteName();
?>

    <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('admin.index')); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo e(config('app.name')); ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php if (\Entrust::hasRole(['admin'])) : ?>
    <?php $__currentLoopData = $admin_side_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(count($menu->appearedChildren) == 0 ): ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo e($menu->id == getParentShowOf($current_page) ? 'active' : null); ?> ">
                <a href="<?php echo e(route('admin.'.$menu->as)); ?>" class="nav-link">
                    <i class="<?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                    <span><?php echo e($menu->display_name); ?></span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        <?php else: ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo e(in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)]) ? 'active' : null); ?>">
                <a class="nav-link <?php echo e(in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)]) ? 'collapsed' : null); ?>"
                   href="#"
                   data-toggle="collapse"
                   data-target="#collapse_<?php echo e($menu->route); ?>"
                   aria-expanded="<?php echo e($menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? 'false' : 'true'); ?>"
                   aria-controls="collapse_<?php echo e($menu->route); ?>">
                    <i class="<?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                    <span><?php echo e($menu->display_name); ?></span>
                </a>

                <?php if($menu->appearedChildren && count($menu->appearedChildren) > 0 ): ?>

                    <div id="collapse_<?php echo e($menu->route); ?>" class="collapse <?php echo e(in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)]) ? 'show' : null); ?>" aria-labelledby="heading_<?php echo e($menu->route); ?>"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $__currentLoopData = $menu->appearedChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="collapse-item <?php echo e(getParentOf($current_page) != null && (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : null); ?>"
                                   href="<?php echo e(route('admin.'.$sub_menu->as)); ?>"><?php echo e($sub_menu->display_name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                <?php endif; ?>

            </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; // Entrust::hasRole ?>

    <?php if (\Entrust::hasRole(['supervisor'])) : ?>
    <?php $__currentLoopData = $admin_side_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (\Entrust::can($menu->name)) : ?>
        <?php if(count($menu->appearedChildren) == 0 ): ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo e($menu->id == getParentShowOf($current_page) ? 'active' : null); ?> ">
                <a href="<?php echo e(route('admin.'.$menu->as)); ?>" class="nav-link">
                    <i class="<?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                    <span><?php echo e($menu->display_name); ?></span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        <?php else: ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'active' : null); ?>">
                <a class="nav-link <?php echo e(in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'collapsed' : null); ?>"
                   href="#"
                   data-toggle="collapse"
                   data-target="#collapse_<?php echo e($menu->route); ?>"
                   aria-expanded="<?php echo e($menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? 'false' : 'true'); ?>"
                   aria-controls="collapse_<?php echo e($menu->route); ?>">
                    <i class="<?php echo e($menu->icon != '' ? $menu->icon : 'fas fa-home'); ?>"></i>
                    <span><?php echo e($menu->display_name); ?></span>
                </a>

                <?php if($menu->appearedChildren !== null && count($menu->appearedChildren) > 0 ): ?>

                    <div id="collapse_<?php echo e($menu->route); ?>"
                         class="collapse <?php echo e(in_array($menu->parent_show,[getParentShowOf($current_page), getParentOf($current_page)]) ? 'show' : null); ?>"
                         aria-labelledby="heading_<?php echo e($menu->route); ?>"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $__currentLoopData = $menu->appearedChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (\Entrust::can($sub_menu->name)) : ?>
                                <a class="collapse-item<?php echo e(getParentOf($current_page) != null && (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : null); ?> "
                                   href="<?php echo e(route('admin.'.$sub_menu->as)); ?>"><?php echo e($sub_menu->display_name); ?></a>
                                <?php endif; // Entrust::can ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                <?php endif; ?>

            </li>
        <?php endif; ?>
        <?php endif; // Entrust::can ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; // Entrust::hasRole ?>


</ul>
<!-- End of Sidebar -->
<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/partial/backend/sidebar.blade.php ENDPATH**/ ?>