<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <?php if(!empty($features) && in_array('Table QR Builder',$features) && in_array('QR Menu', $packagePermissions)): ?>
    <h4 class="page-title">Tables  & QR Builder</h4>
    <?php else: ?>
    <h4 class="page-title">Tables</h4>
    <?php endif; ?>
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
        <?php if(!empty($features) && in_array('Table QR Builder',$features) && in_array('QR Menu', $packagePermissions)): ?>
        <a href="#">Tables & QR Builder</a>
        <?php else: ?>
         <a href="#">Tables</a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-title d-inline-block">Tables</div>
                </div>
                <div class="offset-lg-4 col-lg-4 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Add Table</button>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($tables) == 0): ?>
                <h3 class="text-center">NO TABLE FOUND</h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">Table No</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                        <?php if(!empty($packagePermissions) && in_array('Table QR Builder', $packagePermissions) && in_array('QR Menu', $packagePermissions)): ?>
                          <th scope="col">QR Code</th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($table->table_no); ?></td>
                          <td>
                            <?php if($table->status == 0): ?>
                                <span class="badge badge-danger">Deactive</span>
                            <?php elseif($table->status == 1): ?>
                                <span class="badge badge-success">Active</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm editbtn my-2" href="#editModal" data-toggle="modal" data-table_id="<?php echo e($table->id); ?>" data-table_no="<?php echo e($table->table_no); ?>" data-status="<?php echo e($table->status); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              
                            </a>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('user.table.delete')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="table_id" value="<?php echo e($table->id); ?>">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                
                              </button>
                            </form>
                          </td>
                          <?php if(!empty($packagePermissions) && in_array('Table QR Builder', $packagePermissions)): ?>
                              <td>
                                    <a class="btn btn-info btn-sm editbtn" href="<?php echo e(route('user.table.qr.builder', $table->id)); ?>">
                                        <span class="btn-label">
                                          <i class="fas fa-edit"></i>
                                        </span>
                                        Generate
                                    </a>
                              </td>
                          <?php endif; ?>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Add Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="modal-form create" action="<?php echo e(route('user.table.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for="">Table No **</label>
              <input type="text" class="form-control" name="table_no" value="" placeholder="Enter table no">
              <p id="errtable_no" class="mb-0 text-danger em"></p>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="<?php echo e(route('user.table.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input id="intable_id" type="hidden" name="table_id" value="">
            <div class="form-group">
              <label for="">Table No **</label>
              <input id="intable_no" type="text" class="form-control" name="table_no" value="" placeholder="Enter table no">
              <p id="eerrtable_no" class="mb-0 text-danger em"></p>
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

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/tables/index.blade.php ENDPATH**/ ?>