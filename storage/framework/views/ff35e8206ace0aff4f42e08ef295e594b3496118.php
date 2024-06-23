
<div class="modal fade" id="detailsModal<?php echo e($reservation->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <strong class="text-capitalize">Name:</strong>
                </div>
                <div class="col-lg-8"><?php echo e(convertUtf8($reservation->name)); ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <strong class="text-capitalize">Email:</strong>
                </div>
                <div class="col-lg-8"><?php echo e(convertUtf8($reservation->email)); ?></div>
            </div>
            <hr>

          <?php
            $fields = json_decode($reservation->fields, true);
          ?>

          <?php if(!empty($fields)): ?>
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-lg-4">
                <strong class="text-capitalize"><?php echo e(str_replace("_"," ",$key)); ?>:</strong>
                </div>
                <div class="col-lg-8">
                    <?php if(is_array($field)): ?>
                        <?php
                            $str = implode(", ", $field);
                        ?>
                        <?php echo e(convertUtf8($str)); ?>

                    <?php else: ?>
                        <?php echo e(convertUtf8($field)); ?>

                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-4">
              <strong>Status:</strong>
            </div>
            <div class="col-lg-8">
              <?php if($reservation->status == 1): ?>
                <span class="badge badge-warning">Pending</span>
              <?php elseif($reservation->status == 2): ?>
                <span class="badge badge-success">Accepted</span>
              <?php elseif($reservation->status == 3): ?>
                <span class="badge badge-danger">Rejected</span>
              <?php endif; ?>
            </div>
          </div>
          <hr>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/reservations/reservation-details.blade.php ENDPATH**/ ?>