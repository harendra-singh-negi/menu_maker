

  <div class="modal fade" id="mailModal" data-focus="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Send Mail')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxEditForm" class="" action="<?php echo e(route('user.user.mail')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for=""><?php echo e(__('Email Address')); ?> **</label>
                        <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="Enter email">
                        <p id="eerremail" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo e(__('Subject')); ?> **</label>
                        <input id="insubject" type="text" class="form-control" name="subject" value="" placeholder="<?php echo e(__('Enter subject')); ?>">
                        <p id="eerrsubject" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo e(__('Message')); ?> **</label>
                        <textarea id="inmessage" class="form-control summernote" name="message" placeholder="<?php echo e(__('Enter message')); ?>" data-height="150"></textarea>
                        <p id="eerrmessage" class="mb-0 text-danger em"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                <button id="updateBtn" type="button" class="btn btn-primary"><?php echo e(__('Send Mail')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/product/order/mail.blade.php ENDPATH**/ ?>