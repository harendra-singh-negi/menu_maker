<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">Payment Methods</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('user.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">POS</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Payment Methods</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">Payment Methods</div>
                </div>
                <div class="offset-lg-4 col-lg-4 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Add New</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($pmethods) == 0): ?>
                <h3 class="text-center">NO PAYMENT METHOD FOUND</h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $pmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pmethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($pmethod->name); ?></td>
                          <td>
                            <?php if($pmethod->status == 0): ?>
                                <span class="badge badge-danger">Deactive</span>
                            <?php elseif($pmethod->status == 1): ?>
                                <span class="badge badge-success">Active</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm editbtn" href="#editModal" data-toggle="modal" data-pm_id="<?php echo e($pmethod->id); ?>" data-name="<?php echo e($pmethod->name); ?>" data-status="<?php echo e($pmethod->status); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              Edit
                            </a>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('user.pos.pmethod.delete')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="pm_id" value="<?php echo e($pmethod->id); ?>">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="modal-form create" action="<?php echo e(route('user.pos.pmethod.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for="">Name **</label>
              <input type="text" class="form-control" name="name" value="" placeholder="Enter name">
              <p id="errname" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
                <label for="">Status **</label>
                <select name="status" class="form-control">
                    <option value="" selected disabled>Select a Status</option>
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
                </select>
                <p id="errstatus" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="<?php echo e(route('user.pos.pmethod.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input id="inpm_id" type="hidden" name="pm_id" value="">
            <div class="form-group">
              <label for="">Name **</label>
              <input id="inname" type="text" class="form-control" name="name" value="" placeholder="Enter name">
              <p id="eerrname" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
                <label for="">Status **</label>
                <select id="instatus" name="status" class="form-control">
                    <option value="" selected disabled>Select a Status</option>
                    <option value="0">Deactive</option>
                    <option value="1">Active</option>
                </select>
                <p id="eerrstatus" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="updateBtn" type="button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/payment-methods.blade.php ENDPATH**/ ?>