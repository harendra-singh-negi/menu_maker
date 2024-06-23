<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>



<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Push Notification Settings</h4>
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
                <a href="#">Push Notification</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Settings</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Push Notification Settings</div>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="pushSettingsForm" action="<?php echo e(route('user.pushnotification.updateSettings')); ?>"
                                  method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>Icon Image **</strong></label>
                                            </div>
                                            <div class="col-md-12 showImage mb-3">
                                                <img
                                                    src="<?php echo e(!is_null($bE->push_notification_icon) ? asset('assets/front/img/'.$bE->push_notification_icon) : asset('assets/admin/img/noimage.jpg')); ?>"
                                                    alt="..." class="img-thumbnail" width="200">
                                            </div>
                                            <input type="file" name="file" id="image" class="form-control">
                                            <?php if($errors->has('file')): ?>
                                                <p class="mb-0 text-danger em"><?php echo e($errors->first('file')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>VAPID Public Key</label>
                                    <textarea class="form-control" rows="2" name="VAPID_PUBLIC_KEY"
                                              <?php if(!is_null($bE->VAPID_PUBLIC_KEY)): ?> disabled <?php endif; ?>><?php echo e($bE->VAPID_PUBLIC_KEY); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>VAPID Private Key</label>
                                    <input type="text" name="VAPID_PRIVATE_KEY" class="form-control" <?php if(!is_null($bE->VAPID_PRIVATE_KEY)): ?> disabled <?php endif; ?> value="<?php echo e($bE->VAPID_PRIVATE_KEY); ?>">
                                </div>
                                 <div class="form-group">
                                <p class="text-warning mb-0 d-inline-block">Generate VAPID Public & Private Key </p> <a class="text-primary" target="_blank" href="https://vapidkeys.com/"> Click here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-group from-show-notify row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success" form="pushSettingsForm">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pushnotification/settings.blade.php ENDPATH**/ ?>