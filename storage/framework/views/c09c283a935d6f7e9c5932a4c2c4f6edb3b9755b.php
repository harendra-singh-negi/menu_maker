<?php use App\Constants\Constant;use App\Http\Helpers\Uploader; ?>


<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Edit Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Profile</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Profile Settings</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Profile</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Update Profile</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">

                            <form action="<?php echo e(route('user.update.profile')); ?>" method="post" role="form"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="col-12 mb-2">
                                            <label for="image"><strong>Profile Image</strong></label>
                                        </div>
                                        <div class="col-md-12 showImage mb-3">
                                            <?php if(Auth::guard('web')->user()->image): ?>
                                            <img
                                                src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TENANT_USER_IMAGE,Auth::guard('web')->user()->image,$userBs)); ?>"
                                                alt="..." class="img-thumbnail" width="150">
                                            <?php else: ?> 
                                             <img
                                                src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>"
                                                alt="..." class="img-thumbnail" width="150">
                                            <?php endif; ?>    
                                            <input type="file" name="profile_image" id="image" class="form-control image">
                                        </div>
                                        <?php if($errors->has('profile_image')): ?>
                                            <p class="text-danger mb-0"><?php echo e($errors->first('profile_image')); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Username *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="username"
                                                   value="<?php echo e($user->username); ?>" placeholder="Your Username" type="text">
                                            <?php if($errors->has('username')): ?>
                                                <p class="text-danger mb-0"><?php echo e($errors->first('username')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Email *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="email" value="<?php echo e($user->email); ?>"
                                                   placeholder="Your Email" type="text">
                                            <?php if($errors->has('email')): ?>
                                                <p class="text-danger mb-0"><?php echo e($errors->first('email')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Restaurant Name *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="restaurant_name"
                                                   value="<?php echo e($user->restaurant_name); ?>" placeholder="Your First Name"
                                                   type="text">
                                            <?php if($errors->has('restaurant_name')): ?>
                                                <p class="text-danger mb-0"><?php echo e($errors->first('restaurant_name')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Address *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="address"
                                                   value="<?php echo e($user->address); ?>" placeholder="Your Last Name"
                                                   type="text">
                                            <?php if($errors->has('address')): ?>
                                                <p class="text-danger mb-0"><?php echo e($errors->first('address')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/profile/editprofile.blade.php ENDPATH**/ ?>