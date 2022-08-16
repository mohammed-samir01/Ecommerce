<div wire:poll>
     <div class="chat">
    <div class="chat-header clearfix">
        <div class="row">
            <div class="col-lg-6">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                </a>

            </div>
        </div>
    </div>
    <div class="chat-history">
        <ul class="m-b-0">
            <?php $__empty_1 = true; $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($m->user_id==1): ?>
            
            <li class="clearfix">
                <div class="message-data text-right ">
                    <span class="message-data-time "><?php echo e($m->created_at); ?></span>
                </div>
                <div class="message other-message float-right"> <?php echo e($m->content); ?> </div>

            </li>
            <?php else: ?>
            <li class="clearfix">
                <div class="message-data">
                    <span class="message-data-time"><?php echo e($m->created_at); ?></span>
                </div>
                <div class="message my-message"><?php echo e($m->content); ?></div>
            </li> <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
        </ul>

    </div>

    <div class="chat-message clearfix">
        <form wire:submit.prevent='m'>
            <div class="input-group mb-0">
            <input type="text" class="form-control" placeholder="Enter text here..." name='content' wire:model.defer='mess'>
            <div class="input-group-prepend">
                <button class='btn btn-outline-primary' type='submit'>send</button></div>
            </div>
        </form>
    </div>
</div>
</div>

<?php /**PATH C:\xampp\htdocs\finalecommerce\Ecommerce-BackEnd\resources\views/livewire/chat.blade.php ENDPATH**/ ?>