<?php $__env->startSection('content'); ?>
<div class="page-header">
   <h4 class="page-title">Offline Gateways</h4>
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
         <a href="#">Payment Gateways</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Offline Gateways</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-lg-6">
                  <div class="card-title d-inline-block">Offline Gateways</div>
               </div>
               <div class="col-lg-6 mt-2 mt-lg-0">
                  <a href="#" class="btn btn-primary float-lg-right float-left btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Gateway</a>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="row text-center">
                    <div class="col-lg-12">
                        <div class="form-group">
                           <h5 class="text-warning">Enable the offline gateways from <a href="<?php echo e(route('user.product.servingMethods')); ?>" target="_blank">('Order Management > Serving Methods')</a></h5>
                        </div>
                    </div>
                </div>
            <div class="row">
               <div class="col-lg-12">
                  <?php if(count($ogateways) == 0): ?>
                  <h3 class="text-center">NO OFFLINE PAYMENT GATEWAY FOUND</h3>
                  <?php else: ?>
                  <div class="table-responsive">
                     <table class="table table-striped mt-3" id="basic-datatables">
                        <thead>
                           <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Status</th>
                              <th scope="col">Serial Number</th>
                              <th scope="col">Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $__currentLoopData = $ogateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ogateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                              <td>
                                <?php echo e(convertUtf8($ogateway->name)); ?>

                              </td>
                              <td>
                                <form id="productForm<?php echo e($ogateway->id); ?>" class="d-inline-block" action="<?php echo e(route('user.offline.status')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="ogateway_id" value="<?php echo e($ogateway->id); ?>">
                                <input type="hidden" name="type" value="product">
                                <select class="form-control <?php echo e($ogateway->status == 1 ? 'bg-success' : 'bg-danger'); ?>" name="status" onchange="document.getElementById('productForm<?php echo e($ogateway->id); ?>').submit();">
                                    <option value="1" <?php echo e($ogateway->status == 1 ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo e($ogateway->status == 0 ? 'selected' : ''); ?>>Deactive</option>
                                </select>
                                </form>
                              </td>
                              <td><?php echo e($ogateway->serial_number); ?></td>
                              <td>
                                <a class="btn btn-secondary my-2 btn-sm editbtn" href="#editModal" data-toggle="modal" data-ogateway_id="<?php echo e($ogateway->id); ?>" data-name="<?php echo e($ogateway->name); ?>" data-short_description="<?php echo e($ogateway->short_description); ?>" data-instructions="<?php echo e(replaceBaseUrl($ogateway->instructions)); ?>" data-is_receipt="<?php echo e($ogateway->is_receipt); ?>" data-serial_number="<?php echo e($ogateway->serial_number); ?>">
                                    <span class="btn-label">
                                    <i class="fas fa-edit"></i>
                                    </span>
                                    
                                </a>

                                 <form class="deleteform d-inline-block" action="<?php echo e(route('user.offline.gateway.delete')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="ogateway_id" value="<?php echo e($ogateway->id); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                    <span class="btn-label">
                                    <i class="fas fa-trash"></i>
                                    </span>
                                    
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



<?php if ($__env->exists('user.gateways.offline.create')) echo $__env->make('user.gateways.offline.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if ($__env->exists('user.gateways.offline.edit')) echo $__env->make('user.gateways.offline.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/gateways/offline/index.blade.php ENDPATH**/ ?>