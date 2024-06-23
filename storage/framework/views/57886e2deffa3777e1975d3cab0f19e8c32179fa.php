<?php
    $infoIcon = false;
    use App\Constants\Constant;
    use App\Models\Package;
    use App\Http\Helpers\Uploader;
    use App\Http\Helpers\LimitCheckerHelper;
    $username = '';
    if (Auth::guard('web')->user()->admin_id != null) {
        $user = App\Models\User::where('id', Auth::guard('web')->user()->admin_id)->first();
        $username = $user->username;
        $userId = Auth::guard('web')->user()->admin_id;
    } else {
        $username = Auth::guard('web')->user()->username;
        $userId = Auth::guard('web')->user()->id;
    }

    $packageId = LimitCheckerHelper::getMembershipId($userId);
    $currentPackage = Package::find($packageId);

    $feature = json_decode($currentPackage->features, true);


    if ($currentPackage) {
        $staffCount = LimitCheckerHelper::staffCount($userId);
        $storageCount = LimitCheckerHelper::storageCount($userId, 'storage_usage');

        $orderCount = LimitCheckerHelper::orderCount($userId);
        $categoryCount = LimitCheckerHelper::categoryCount($userId);
        $subcategoryCount = LimitCheckerHelper::subcategoryCount($userId);
        $itemCount = LimitCheckerHelper::itemCount($userId);
        $languageCount = LimitCheckerHelper::languageCount($userId);
        $reservationCount = LimitCheckerHelper::getTableReservationCount($userId);
    }
    if($reservationCount >= $currentPackage->table_reservation_limit || $orderCount >= $currentPackage->order_limit){
         $infoIcon = true;
    }
    else if ($staffCount > $currentPackage->staff_limit || $storageCount > $currentPackage->storage_limit  || $categoryCount > $currentPackage->categories_limit || $subcategoryCount > $currentPackage->subcategories_limit || $itemCount > $currentPackage->items_limit || $languageCount > $currentPackage->language_limit ) {
        $infoIcon = true;
    }

?>



<div class="main-header">

    <div class="logo-header" <?php if(request()->cookie('user-theme') == 'dark'): ?> data-background-color="dark2" <?php endif; ?>>
        <?php if($userBs->logo): ?>
            <a href="<?php echo e(route('user.front.index', $username)); ?>" class="logo" target="_blank">
                <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_LOGO, $userBs->logo, $userBs)); ?>" alt="navbar brand"
                    width="120">
            </a>
        <?php else: ?>
            <a class="logo" href="<?php echo e(route('user.front.index', $username)); ?>">
                <img src="<?php echo e(asset('assets/restaurant/images/logo.png')); ?>" alt="Logo" width="120">
            </a>
        <?php endif; ?>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button
                class="btn btn-toggle
          <?php if(request()->routeIs('user.pos') || request()->routeIs('user.table.qr.builder') || request()->routeIs('user.qrcode')): ?> sidenav-overlay-toggler
          <?php else: ?>
              toggle-sidebar <?php endif; ?>
              toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>

    <nav class="navbar navbar-header navbar-expand-lg"
        <?php if(request()->cookie('user-theme') == 'dark'): ?> data-background-color="dark" <?php endif; ?>>
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <form action="<?php echo e(route('user.theme.change')); ?>" class="mr-4 form-inline" id="userThemeForm">
                    <div class="form-group">
                        <div class="selectgroup selectgroup-secondary selectgroup-pills">
                            <label class="selectgroup-item">
                                <input type="radio" name="theme" value="light" class="selectgroup-input"
                                    <?php echo e(empty(request()->cookie('user-theme')) || request()->cookie('user-theme') == 'light' ? 'checked' : ''); ?>

                                    onchange="document.getElementById('userThemeForm').submit();">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                        class="fa fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="theme" value="dark" class="selectgroup-input"
                                    <?php echo e(request()->cookie('user-theme') == 'dark' ? 'checked' : ''); ?>

                                    onchange="document.getElementById('userThemeForm').submit();">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                        class="fa fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                </form>
                <li>
                <li class="mr-4">
                    <a class="btn btn-primary btn-sm btn-round" target="_blank"
                        href="<?php echo e(route('user.front.index', $username)); ?>" title="View Website">
                        <i class="fas fa-eye"></i>
                    </a>
                </li>
                <?php if(Auth::guard('web')->user()->admin_id == null): ?>
                    <li class="d-flex mr-4">
                        <label class="switch">
                            <input type="checkbox" name="online_status" id="toggle-btn" data-toggle="toggle"
                                data-on="1" data-off="0" <?php if(Auth::guard('web')->user()->online_status == 1): ?> checked <?php endif; ?>>
                            <span class="slider round"></span>
                        </label>
                        <?php if(Auth::guard('web')->user()->online_status == 1): ?>
                            <h5 class="mt-2 ml-2 <?php if(request()->cookie('user-theme') == 'dark'): ?> text-white <?php endif; ?>">
                                <?php echo e(__('Active')); ?>

                            </h5>
                        <?php else: ?>
                            <h5 class="mt-2 ml-2 <?php if(request()->cookie('user-theme') == 'dark'): ?> text-white <?php endif; ?>">
                                <?php echo e(__('Deactive')); ?>

                            </h5>
                        <?php endif; ?>
                    </li>

                    <li class="d-flex mr-4">
                        <a class="btn btn-secondary  btn-sm" data-toggle="modal" data-target="#limitModal">
                            <span class="text-white">Check Limit

                            </span> <br>

                            <span class="view_limit">Click Here To View</span>
                        </a>
                        <sup class="float-start">
                            <?php if($infoIcon == true): ?>
                                <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15 class="errorIcon">
                            <?php endif; ?>
                        </sup>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TENANT_USER_IMAGE, Auth::guard('web')->user()->image, $userBs, 'assets/tenant/image/user.jpg')); ?>"
                                alt="..." class="avatar-img rounded-circle" width="120">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TENANT_USER_IMAGE, Auth::guard('web')->user()->image, $userBs, 'assets/tenant/image/user.jpg')); ?>"
                                            alt="..." class="avatar-img rounded" width="120">
                                    </div>
                                    <div class="u-text">
                                        <h4><?php echo e(Auth::guard('web')->user()->first_name); ?></h4>
                                        <p class="text-muted"><?php echo e(Auth::guard('web')->user()->email); ?></p><a
                                            href="<?php echo e(route('user.edit.profile')); ?>"
                                            class="btn btn-xs btn-secondary btn-sm">Edit Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('user.edit.profile')); ?>">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('user.change.password')); ?>">Change
                                    Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</div>

<div class="modal fade" id="limitModal" tabindex="-1" aria-labelledby="limitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="limitModalLabel">All Limit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($currentPackage): ?>

                    <ul class="list-group modal_ul">
                        <?php if(is_array($feature) && in_array('Staffs', $feature)): ?>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($staffCount > $currentPackage->staff_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Staffs Left :
                                </span>
                                <span
                                    class="badge badge-primary badge-sm"><?php echo e($currentPackage->staff_limit == 999999 ? 'Unlimited' : ($currentPackage->staff_limit - $staffCount < 0 ? 0 : $currentPackage->staff_limit - $staffCount)); ?></span>
                            </div>
                            <?php if($staffCount > $currentPackage->staff_limit): ?>
                                <p class="text-warning m-0">Limit has been crossed, you have to delete
                                    <?php echo e(abs($currentPackage->staff_limit - $staffCount)); ?>

                                    <?php echo e(abs($currentPackage->staff_limit - $staffCount) == 1 ? 'staff' : 'staffs'); ?>

                                </p>
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <?php if(is_array($feature) && in_array('Online Order', $feature)): ?>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($orderCount >= $currentPackage->order_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Orders Left :
                                </span>

                                <span class="badge badge-primary badge-sm">
                                    <?php echo e($currentPackage->order_limit == 999999 ? 'Unlimited' : ($currentPackage->order_limit - $orderCount < 0 ? 0 : $currentPackage->order_limit - $orderCount)); ?>

                                </span>
                            </div>

                            <?php if($orderCount >= $currentPackage->order_limit): ?>
                                <p class="text-warning m-0">Please buy a new package to receive more orders

                                </p>
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($categoryCount > $currentPackage->categories_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Categories Left :
                                </span>
                                <span class="badge badge-primary badge-sm">
                                    <?php echo e($currentPackage->categories_limit == 999999
                                        ? 'Unlimited'
                                        : ($currentPackage->categories_limit - $categoryCount < 0
                                            ? 0
                                            : $currentPackage->categories_limit - $categoryCount)); ?>

                                </span>
                            </div>

                            <?php if($categoryCount > $currentPackage->categories_limit): ?>
                                <p class="text-warning m-0">Limit has been crossed, you have to delete
                                    <?php echo e(abs($currentPackage->categories_limit - $categoryCount)); ?>

                                    <?php echo e(abs($currentPackage->categories_limit - $categoryCount) == 1 ? 'category' : 'categories'); ?>

                                </p>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <label>
                                    <?php if($subcategoryCount > $currentPackage->subcategories_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Subcategories Left :
                                </label>
                                <span
                                    class="badge badge-primary badge-sm"><?php echo e($currentPackage->subcategories_limit == 999999 ? 'Unlimited' : ($currentPackage->subcategories_limit - $subcategoryCount < 0 ? 0 : $currentPackage->subcategories_limit - $subcategoryCount)); ?>

                                </span>
                            </div>
                            <?php if($subcategoryCount > $currentPackage->subcategories_limit): ?>
                                <p class="text-warning m-0">Limit has been crossed, you have to delete
                                    <?php echo e(abs($currentPackage->subcategories_limit - $subcategoryCount)); ?>

                                    <?php echo e(abs($currentPackage->subcategories_limit - $subcategoryCount) == 1 ? 'subcategory' : 'subcategories'); ?>

                                </p>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($itemCount > $currentPackage->items_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Items Left :
                                </span>
                                <span class="badge badge-primary badge-sm">
                                    <?php echo e($currentPackage->items_limit == 999999
                                        ? 'Unlimited'
                                        : ($currentPackage->items_limit - $itemCount < 0
                                            ? 0
                                            : $currentPackage->items_limit - $itemCount)); ?>

                                </span>
                            </div>
                            <?php if($itemCount > $currentPackage->items_limit): ?>
                                <p class="text-warning m-0">Limit has been crossed, you have to delete
                                    <?php echo e(abs($currentPackage->items_limit - $itemCount)); ?>

                                    <?php echo e(abs($currentPackage->items_limit - $itemCount) < 0 ? 'item' : 'items'); ?>


                                </p>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($languageCount > $currentPackage->language_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon ">
                                    <?php endif; ?> Languages Left :
                                </span>
                                <span
                                    class="badge badge-primary badge-sm"><?php echo e($currentPackage->language_limit == 999999 ? 'Unlimited' : ($currentPackage->language_limit - $languageCount < 0 ? 0 : $currentPackage->language_limit - $languageCount)); ?></span>
                            </div>
                            <?php if($languageCount > $currentPackage->language_limit): ?>
                                <p class="text-warning m-0">Limit has been crossed, you have to delete
                                    <?php echo e(abs($currentPackage->language_limit - $languageCount)); ?>

                                    <?php echo e(abs($currentPackage->language_limit - $languageCount) == 1 ? 'language' : 'languages'); ?>


                                </p>
                            <?php endif; ?>
                        </li>
                        <?php if(is_array($feature) && in_array('Table Reservation', $feature)): ?>
                        <li class="list-group-item">
                            <div class="d-flex  justify-content-between">
                                <span>
                                    <?php if($reservationCount >= $currentPackage->table_reservation_limit): ?>
                                        <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                            class="errorIcon">
                                    <?php endif; ?> Table Reservations Left :
                                </span>
                                <span
                                    class="badge badge-primary badge-sm"><?php echo e($currentPackage->table_reservation_limit == 999999 ? 'Unlimited' : ($currentPackage->table_reservation_limit - $reservationCount < 0 ? 0 : $currentPackage->table_reservation_limit - $reservationCount)); ?></span>
                            </div>
                            <?php if($reservationCount >= $currentPackage->table_reservation_limit): ?>
                                <p class="text-warning m-0"> Please buy a new package to receive more  table reservations
                                </p>
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>
                        <?php if(is_array($feature) && in_array('Storage Limit', $feature)): ?>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?php if($storageCount > $currentPackage->storage_limit): ?>
                                            <img src="<?php echo e(asset('assets/user/img/error.png')); ?>" width="15"
                                                class="errorIcon ">
                                            Storage Left:
                                        <?php else: ?>
                                            Storage Left:
                                        <?php endif; ?>
                                    </span>
                                    <span class="badge badge-primary badge-sm">
                                        <?php if($storageCount > $currentPackage->storage_limit): ?>
                                            0
                                        <?php else: ?>
                                            <?php if($currentPackage->storage_limit == 999999): ?>
                                                <?php echo e(__('Unlimited')); ?>

                                            <?php else: ?>
                                                <?php if($currentPackage->storage_limit >= 1024): ?>
                                                    <?php echo e(number_format(($currentPackage->storage_limit - $storageCount) / 1024, 2)); ?>

                                                    <?php echo e(__('GB')); ?>

                                                <?php else: ?>
                                                    <?php echo e($currentPackage->storage_limit - $storageCount); ?>

                                                    <?php echo e(__('MB')); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <?php if($storageCount > $currentPackage->storage_limit): ?>
                                <p class="text-warning m-0">
                                    Your storage limit exceeded
                                </p>
                            <?php endif; ?>
                            </li>

                        <?php endif; ?>

                    </ul>
                <?php else: ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

  <style>
    .modal_ul{
    border: 1px solid #0000005a !important;
  }
  .view_limit{
    color:#ffffffbd;
    font-size: 10px
  }
  </style>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/top-navbar.blade.php ENDPATH**/ ?>