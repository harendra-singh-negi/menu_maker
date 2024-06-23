<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>



<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Staffs</h4>
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
                <a href="#">Staffs Management</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Staffs</a>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center align-items-center mb-1">
        <div class="col-12">
            <div class="alert border-left border-primary text-dark d-flex justify-content-space-between">
                <?php
                    $user = getRootUser();
                ?>

                <div>
                    Path: <strong class="text-danger">
                        <?php
                            $url = url('/') . '/' . $user->username . '/user/login';
                        ?>
                        <a href="<?php echo e($url); ?>" target="_blank"><?php echo e($url); ?></a>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">Admins</div>
                    <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i>
                        Add Staff
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($users) == 0): ?>
                                <h3 class="text-center"><?php echo e(__('NO USER FOUND')); ?></h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td>
                                                        <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TENANT_USER_IMAGE, $user->image, $userBs)); ?>"
                                                             width="80" height="80">
                                                    </td>
                                                    <td><?php echo e($user->username); ?></td>
                                                    <td><?php echo e($user->email); ?></td>
                                                    <td><?php echo e($user->first_name); ?></td>
                                                    <td><?php echo e($user->last_name); ?></td>
                                                    <td>
                                                        <?php if(empty($user->role)): ?>
                                                            <span class="badge badge-danger">Owner</span>
                                                        <?php else: ?>
                                                            <?php echo e($user->role->name); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($user->status == 1): ?>
                                                            <span class="badge badge-success">Active</span>
                                                        <?php elseif($user->status == 0): ?>
                                                            <span class="badge badge-danger">Deactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button class="btn btn-info btn-sm dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('user.admin.edit', $user->id)); ?>">
                                                                   
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('user.admin.change.password')); ?>" target="_blank">Change
                                                                    Password</a>
                                                                <form class="deleteform dropdown-item"
                                                                    action="<?php echo e(route('user.admin.delete')); ?>"
                                                                    method="post">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?php echo e($user->id); ?>">
                                                                    <button type="submit"
                                                                        class=" deletebtn">
                                                                       
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                <form class="d-block"
                                                                    action="<?php echo e(route('user.admin.secretLogin')); ?>"
                                                                    method="post" target="_blank">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?php echo e($user->id); ?>">
                                                                    <button class="dropdown-item "
                                                                        role="button"><?php echo e(__('Secret Login')); ?></button>
                                                                </form>
                                                            </div>
                                                        </div>


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

    <?php if ($__env->exists('user.admin.create')) echo $__env->make('user.admin.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/admin/index.blade.php ENDPATH**/ ?>