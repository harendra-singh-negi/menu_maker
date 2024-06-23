<?php
  use App\Constants\Constant;
  use App\Http\Helpers\Uploader;
  use App\Http\Helpers\UserPermissionHelper;
  use App\Models\User\BasicSetting;
  use App\Models\User\Language;
  use Illuminate\Support\Facades\Auth;
    $user = getRootUser();
    $default = Language::query()
                        ->where('is_default', 1)
                        ->where('user_id', $user->id)
                        ->first();
    $package = UserPermissionHelper::currentPackage($user->id);
    if (!empty($user)) {
        $permissions = UserPermissionHelper::packagePermission($user->id);
        $permissions = json_decode($permissions, true);
        $userBs = BasicSetting::query()->where('user_id', $user->id)->first();
    }
    $roleBasedPermission = [];
   
    if (!is_null(Auth::guard('web')->user()->admin_id)){
       $roleBasedPermission = json_decode(Auth::guard('web')->user()->role->permissions, true);
    }


?>


<div class="sidebar sidebar-style-2" <?php if(request()->cookie('user-theme') == 'dark'): ?> data-background-color="dark2" <?php endif; ?>>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <img
            src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TENANT_USER_IMAGE, Auth::guard('web')->user()->image, $userBs, 'assets/tenant/image/user.jpg')); ?>"
            alt="..." class="avatar-img rounded">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
             <?php if(is_null(Auth::guard('web')->user()->admin_id)): ?>
            <span>
              <?php echo e(Auth::guard('web')->user()->username); ?>

              <span class="user-level">Admin</span>
              <span class="caret"></span>
            </span>
            <?php else: ?>
             <span>
              <?php echo e(Auth::guard('web')->user()->first_name); ?>

              <span class="user-level">Staff</span>
              <span class="caret"></span>
            </span>
            <?php endif; ?>
          </a>
          <div class="clearfix"></div>

          <div class="collapse in" id="collapseExample">
            <ul class="nav">
              <li>
                <a href="<?php echo e(route('user.edit.profile')); ?>">
                  <span class="link-collapse"><?php echo e(__('Edit Profile')); ?></span>
                </a>
              </li>
              <li>
                <a href="<?php echo e(route('user.change.password')); ?>">
                  <span class="link-collapse"><?php echo e(__('Change Password')); ?></span>
                </a>
              </li>
              <li>
                <a href="<?php echo e(route('user.logout')); ?>">
                  <span class="link-collapse"><?php echo e(__('Logout')); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav nav-primary">
        <div class="row mb-2">
          <div class="col-12">
           
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control  sidebar-search" 
                  placeholder="Search Menu Here...">
              </div>
          
          </div>
        </div>
    
        <li class="nav-item <?php if(request()->path() == 'user/dashboard'): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('user.dashboard')); ?>">
            <i class="la flaticon-paint-palette"></i>
            <p><?php echo e(__('Dashboard')); ?></p>
          </a>
        </li>
        <?php if(!is_null($package) && (in_array('Subdomain', $permissions) || in_array('Custom Domain', $permissions)) && (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission)&& in_array('Domains & URLs',$roleBasedPermission)))): ?>
          <li
            class="nav-item
            <?php if(request()->path() == 'user/domains'): ?> active
            <?php elseif(request()->path() == 'user/subdomain'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#domains">
              <i class="fas fa-link"></i>
              <p><?php echo e(__('Domains & URLs')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
                <?php if(request()->path() == 'user/domains'): ?> show
                <?php elseif(request()->path() == 'user/subdomain'): ?> show <?php endif; ?>"
              id="domains">
              <ul class="nav nav-collapse">
                <?php if(!empty($permissions) && in_array('Custom Domain', $permissions)): ?>
                  <li class="
                        <?php if(request()->path() == 'user/domains'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.domains')); ?>">
                      <span class="sub-item"><?php echo e(__('Custom Domain')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if(!empty($permissions) && in_array('Subdomain', $permissions)): ?>
                  <li class="
                        <?php if(request()->path() == 'user/subdomain'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.subdomain')); ?>">
                      <span class="sub-item"><?php echo e(__('Subdomain & Path URL')); ?></span>
                    </a>
                  </li>
               
                <?php endif; ?>
              </ul>
            </div>
          </li>
        <?php endif; ?>
      
        <?php if(
            !is_null($package) &&
                (!empty($permissions) && in_array('POS', $permissions)) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('POS', $roleBasedPermission)))): ?>
          <li
            class="nav-item
          <?php if(request()->path() == 'user/pos'): ?> active
          <?php elseif(request()->path() == 'user/pos/payment-methods'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#pos">
              <i class="fas fa-cart-plus"></i>
              <p>POS</p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/pos'): ?> show
            <?php elseif(request()->path() == 'user/pos/payment-methods'): ?> show <?php endif; ?>"
              id="pos">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/pos'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pos')); ?>">
                    <span class="sub-item"><?php echo e(__('POS')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/pos/payment-methods'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pos.pmethod.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Payment Methods')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        <?php if(
            (!is_null($package) && in_array('POS', $permissions) ||
                in_array('Online Order', $permissions)) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Order Management', $roleBasedPermission)))
               
            ): ?>
         
          <li
            class="nav-item
          <?php if(request()->path() == 'user/product/orders'): ?> active
          <?php elseif(request()->path() == 'user/order/settings'): ?> active
          <?php elseif(request()->is('user/product/orders/details/*')): ?> active
          <?php elseif(request()->is('user/product/order/serving-methods')): ?> active
          <?php elseif(request()->routeIs('user.postalcode.index')): ?> active
          <?php elseif(request()->path() == 'user/shipping'): ?> active
          <?php elseif(request()->routeIs('user.shipping.edit')): ?> active
          <?php elseif(request()->path() == 'user/coupon'): ?> active
          <?php elseif(request()->routeIs('user.coupon.edit')): ?> active
          <?php elseif(request()->path() == 'user/ordertime'): ?> active
          <?php elseif(request()->path() == 'user/orders/sales-report'): ?> active
          <?php elseif(request()->path() == 'user/orders/sales-report/export'): ?> active
          <?php elseif(request()->path() == 'user/deliverytime'): ?> active
          <?php elseif(request()->path() == 'user/t/timeframes'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#orderManagement">
              <i class="fas fa-box"></i>
              <p><?php echo e(__('Order Management')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/product/orders'): ?> show
            <?php elseif(request()->path() == 'user/order/settings'): ?> show
            <?php elseif(request()->is('user/product/orders/details/*')): ?> show
            <?php elseif(request()->is('user/product/order/serving-methods')): ?> show
            <?php elseif(request()->routeIs('user.postalcode.index')): ?> show
            <?php elseif(request()->path() == 'user/shipping'): ?> show
            <?php elseif(request()->routeIs('user.shipping.edit')): ?> show
            <?php elseif(request()->path() == 'user/coupon'): ?> show
            <?php elseif(request()->routeIs('user.coupon.edit')): ?> show
            <?php elseif(request()->path() == 'user/ordertime'): ?> show
            <?php elseif(request()->path() == 'user/deliverytime'): ?> show
            <?php elseif(request()->path() == 'user/orders/sales-report'): ?> show
            <?php elseif(request()->path() == 'user/orders/sales-report/export'): ?> show
            <?php elseif(request()->path() == 'user/t/timeframes'): ?> show <?php endif; ?>"
              id="orderManagement">
              <ul class="nav nav-collapse">
                <li class="
                <?php if(request()->path() == 'user/order/settings'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.order.settings')); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>

                <li
                  class="
                <?php if(request()->path() == 'user/product/orders'): ?> active
                <?php elseif(request()->is('user/product/orders/details/*')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.product.orders')); ?>">
                    <span class="sub-item"><?php echo e(__('Orders')); ?></span>
                  </a>
                </li>

                <li class="
                  <?php if(request()->is('user/orders/sales-report')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.sales.report')); ?>">
                    <span class="sub-item"><?php echo e(__('Sales Reports')); ?></span>
                  </a>
                </li>

                <li class="
                  <?php if(request()->is('user/product/order/serving-methods')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.product.servingMethods')); ?>">
                    <span class="sub-item"><?php echo e(__('Serving Methods')); ?></span>
                  </a>
                </li>

                <?php if(
                    !empty($packagePermissions) &&
                        in_array('Home Delivery', $packagePermissions) &&
                        in_array('Postal Code Based Delivery Charge', $packagePermissions)): ?>
                  <li class="
                                    <?php if(request()->routeIs('user.postalcode.index')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.postalcode.index') . '?language=' . $default->code); ?>">
                      <span class="sub-item"><?php echo e(__('Postal Codes')); ?></span>
                    </a>
                  </li>
                <?php elseif(!empty($packagePermissions) && in_array('Postal Code Based Delivery Charge', $packagePermissions)): ?>
                <?php endif; ?>

                <?php if(!empty($packagePermissions) && in_array('Home Delivery', $packagePermissions)): ?>
                  <li
                    class="
                <?php if(request()->path() == 'user/shipping'): ?> active
                <?php elseif(request()->routeIs('user.shipping.edit')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.shipping.index') . '?language=' . $default->code); ?>">
                      <span class="sub-item"><?php echo e(__('Shipping Charges')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if(!empty($permissions) && in_array('Coupon', $permissions) && in_array('Online Order', $packagePermissions)): ?>
                  <li
                    class="
                <?php if(request()->path() == 'user/coupon'): ?> active
                <?php elseif(request()->routeIs('user.coupon.edit')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.coupon.index')); ?>">
                      <span class="sub-item"><?php echo e(__('Coupons')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                  <li class="
                <?php if(request()->path() == 'user/ordertime'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.ordertime')); ?>">
                      <span class="sub-item"><?php echo e(__('Order Time Management')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
              
                <?php if(!empty($packagePermissions) && in_array('Home Delivery', $packagePermissions)): ?>
                  <li
                    class="
                <?php if(request()->path() == 'user/deliverytime'): ?> active
                <?php elseif(request()->path() == 'user/t/timeframes'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.deliverytime')); ?>">
                      <span class="sub-item"><?php echo e(__('Delivery Time Frames Management')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </li>
        <?php endif; ?>
 
        
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Items Management', $roleBasedPermission)))): ?>
          <li
            class="nav-item
                        <?php if(request()->path() == 'user/category'): ?> active
                        <?php elseif(request()->path() == 'user/subcategory'): ?> active
                        <?php elseif(request()->path() == 'user/subcategory/*'): ?> active
                        <?php elseif(request()->path() == 'user/product'): ?> active
                        <?php elseif(request()->path() == 'user/product/create'): ?> active
                        <?php elseif(request()->is('user/product/*/edit')): ?> active
                        <?php elseif(request()->is('user/category/*/edit')): ?> active >
                        <?php elseif(request()->is('user/subcategory/*/edit')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#category">
              <i class="fas fa-list"></i>
              <p><?php echo e(__('Items Management')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
                        <?php if(request()->path() == 'user/category'): ?> show
                        <?php elseif(request()->path() == 'user/subcategory'): ?> show
                        <?php elseif(request()->path() == 'user/subcategory/*'): ?> show
                        <?php elseif(request()->path() == 'user/product/create'): ?> show
                        <?php elseif(request()->is('user/category/*/edit')): ?> show
                        <?php elseif(request()->is('user/subcategory/*/edit')): ?> show
                        <?php elseif(request()->path() == 'user/product'): ?> show
                        <?php elseif(request()->is('user/product/*/edit')): ?> show <?php endif; ?>"
              id="category">
              <ul class="nav nav-collapse">
                <li
                  class="
                <?php if(request()->path() == 'user/category'): ?> active
                <?php elseif(request()->is('user/category/*/edit')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.category.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Category & Tax')); ?></span>
                  </a>
                </li>
                <li
                  class=" <?php if(request()->path() == 'user/subcategory'): ?> active
                                <?php elseif(request()->is('user/subcategory/*/edit')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.subcategory.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Subcategories')); ?></span>
                  </a>
                </li>

                <li
                  class="
                <?php if(request()->path() == 'user/product'): ?> active
                <?php elseif(request()->is('user/product/*/edit')): ?> active
                <?php elseif(request()->path() == 'user/product/create'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.product.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Items')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

     
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) &&
                in_array('QR Menu', $packagePermissions))  ||
                (in_array('QR Menu', $packagePermissions) && is_array($roleBasedPermission) && in_array('QR Code Builder', $roleBasedPermission))
            ): ?>
          <li class="nav-item
                        <?php if(request()->path() == 'user/qr-code'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.qrcode')); ?>">
              <i class="fas fa-qrcode"></i>
              <p><?php echo e(__('QR Code Builder')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        <?php if(
            !is_null($package) &&
                !empty($permissions) &&
                in_array('Table Reservation', $permissions) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Reservation Settings', $roleBasedPermission)))): ?>
          <li
            class="nav-item
                          <?php if(request()->path() == 'user/reservations/visibility'): ?> active
                          <?php elseif(request()->path() == 'user/reservation/form'): ?> active
                          <?php elseif(request()->is('user/reservation/*/inputEdit')): ?> active
                          <?php elseif(request()->path() == 'user/table/section'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#reserveSet">
              <i class="fas fa-backward"></i>
              <p><?php echo e(__('Reservation Settings')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
                            <?php if(request()->path() == 'user/reservations/visibility'): ?> show
                            <?php elseif(request()->path() == 'user/reservation/form'): ?> show
                            <?php elseif(request()->is('user/reservation/*/inputEdit')): ?> show
                            <?php elseif(request()->path() == 'user/table/section'): ?> show <?php endif; ?>"
              id="reserveSet">
              <ul class="nav nav-collapse">
                <li class="
                                <?php if(request()->path() == 'user/reservations/visibility'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.reservations.visibility')); ?>">
                    <span class="sub-item"><?php echo e(__('Visibility')); ?></span>
                  </a>
                </li>
                <li class="
                                <?php if(request()->path() == 'user/table/section'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.table.section.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Text & Image')); ?></span>
                  </a>
                </li>
                <li
                  class="
                                <?php if(request()->path() == 'user/reservation/form'): ?> active
                                <?php elseif(request()->is('user/reservation/*/inputEdit')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.reservation.form') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Form Builder')); ?></span>
                  </a>
                </li>

              </ul>
            </div>
          </li>
        <?php endif; ?>

        <?php if(
            !is_null($package) &&
                !empty($permissions) &&
                in_array('Table Reservation', $permissions) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Table Reservations', $roleBasedPermission)))): ?>
          <li class="nav-item  <?php if(request()->is('user/table/reservations/*')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#table">
              <i class="fas fa-utensils"></i>
              <p><?php echo e(__('Table Reservations')); ?></p>
              <span class="caret"></span>
            </a>
            <div class="collapse  <?php if(request()->is('user/table/reservations/*')): ?> show <?php endif; ?>" id="table">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/table/reservations/create'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.table.reservations.new') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('New Reservation')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/table/reservations/all'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.all.table.reservations')); ?>">
                    <span class="sub-item"><?php echo e(__('All Reservations')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/table/reservations/pending'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pending.table.reservations')); ?>">
                    <span class="sub-item"><?php echo e(__('Pending Reservations')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->path() == 'user/table/reservations/accepted'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.accepted.table.reservations')); ?>">
                    <span class="sub-item"><?php echo e(__('Accepted Reservations')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/table/reservations/rejected'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.rejected.table.reservations')); ?>">
                    <span class="sub-item"><?php echo e(__('Rejected Reservations')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

          <?php if(
            !is_null($package) &&
                !empty($permissions) &&
                in_array('Table QR Builder', $permissions) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Tables & QR Builder', $roleBasedPermission)))): ?>
                
          <li class="nav-item
                    <?php if(request()->path() == 'user/tables'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.table.index')); ?>">
              <i class="fas fa-table"></i>
              <p><?php echo e(__('Tables & QR Builder')); ?></p>

            </a>
          </li>
        <?php elseif(is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Tables & QR Builder', $roleBasedPermission))): ?>
     
          <li class="nav-item
                    <?php if(request()->path() == 'user/tables'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.table.index')); ?>">
              <i class="fas fa-table"></i>
              <p><?php echo e(__('Tables')); ?></p>

            </a>
          </li>
        <?php endif; ?>
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Drag & Drop Menu Builder', $roleBasedPermission)))): ?>
        
          <li class="nav-item
                 <?php if(request()->path() == 'user/menu-builder'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.menu_builder.index') . '?language=' . $default->code); ?>">
              <i class="fas fa-bars"></i>
              <p><?php echo e(__('Drag & Drop Menu Builder')); ?></p>
            </a>
          </li>
        <?php endif; ?>
        <?php if(
            !is_null($package) &&
                !empty($permissions) &&
                in_array('Custom Page', $permissions) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Custom Pages', $roleBasedPermission)))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('user.custom_pages')): ?> active
                <?php elseif(request()->routeIs('user.custom_pages.create_page')): ?> active
                <?php elseif(request()->routeIs('user.custom_pages.edit_page')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.custom_pages', ['language' => $default->code])); ?>">
              <i class="la flaticon-file"></i>
              <p><?php echo e(__('Custom Pages')); ?></p>
            </a>
          </li>
        <?php endif; ?>
     
        <?php if(
            !is_null($package) &&
                !is_null($packagePermissions) &&
                in_array('Blog', $packagePermissions) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Blog Management', $roleBasedPermission)))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('user.blog_management.categories')): ?> active
                <?php elseif(request()->routeIs('user.blog_management.blogs')): ?> active
                <?php elseif(request()->routeIs('user.blog_management.create_blog')): ?> active
                <?php elseif(request()->routeIs('user.blog_management.edit_blog')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#blog">
              <i class="fas fa-book"></i>
              <p><?php echo e(__('Blog Management')); ?></p>
              <span class="caret"></span>
            </a>
            <div id="blog"
              class="collapse
                    <?php if(request()->routeIs('user.blog_management.categories')): ?> show
                    <?php elseif(request()->routeIs('user.blog_management.blogs')): ?> show
                    <?php elseif(request()->routeIs('user.blog_management.create_blog')): ?> show
                    <?php elseif(request()->routeIs('user.blog_management.edit_blog')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('user.blog_management.categories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('user.blog_management.categories', ['language' => $default->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Categories')); ?></span>
                  </a>
                </li>
                <li
                  class="<?php if(request()->routeIs('user.blog_management.blogs')): ?> active
                            <?php elseif(request()->routeIs('user.blog_management.create_blog')): ?> active
                            <?php elseif(request()->routeIs('user.blog_management.edit_blog')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.blog_management.blogs', ['language' => $default->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Blog')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
    
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Language Management', $roleBasedPermission)))): ?>
          <li
            class="nav-item
                <?php if(request()->path() == 'user/languages'): ?> active
                <?php elseif(request()->is('user/language/*/edit')): ?> active
                <?php elseif(request()->is('user/language/*/edit/keyword')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.language.index')); ?>">
              <i class="fas fa-language"></i>
              <p><?php echo e(__('Language Management')); ?></p>
            </a>
          </li>
        <?php endif; ?>
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Payment Gateways', $roleBasedPermission)))): ?>
          <li
            class="nav-item
                <?php if(request()->path() == 'user/gateways'): ?> active
                <?php elseif(request()->path() == 'user/offline/gateways'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#gateways">
              <i class="la flaticon-paypal"></i>
              <p><?php echo e(__('Payment Gateways')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
                    <?php if(request()->path() == 'user/gateways'): ?> show
                    <?php elseif(request()->path() == 'user/offline/gateways'): ?> show <?php endif; ?>"
              id="gateways">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/gateways'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.gateway.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Online Gateways')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/offline/gateways'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.gateway.offline') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Offline Gateways')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
      
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Website Pages', $roleBasedPermission)))): ?>
          <?php if ($__env->exists('user.partials.website-pages')) echo $__env->make('user.partials.website-pages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
      
       
        <?php if(!is_null($package) && is_null(Auth::guard('web')->user()->admin_id)  && (is_array($roleBasedPermission) && in_array('Table QR Builder', $roleBasedPermission) || (is_array($roleBasedPermission) && in_array('Settings', $roleBasedPermission)))): ?>
      
          <li
            class="nav-item
          <?php if(request()->path() == 'user/favicon'): ?> active
          <?php elseif(request()->path() == 'user/logo'): ?> active
          <?php elseif(request()->path() == 'user/preloader'): ?> active
          <?php elseif(request()->path() == 'user/basic-info'): ?> active
          <?php elseif(request()->path() == 'user/support'): ?> active
          <?php elseif(request()->path() == 'user/social'): ?> active
          <?php elseif(request()->is('user/social/*')): ?> active
          <?php elseif(request()->path() == 'user/basic_settings/seo'): ?> active
          <?php elseif(request()->path() == 'user/breadcrumb'): ?> active
          <?php elseif(request()->path() == 'user/heading'): ?> active
          <?php elseif(request()->path() == 'user/plugins'): ?> active
          <?php elseif(request()->path() == 'user/seo'): ?> active
          <?php elseif(request()->path() == 'user/pwa'): ?> active
          <?php elseif(request()->path() == 'user/maintenance'): ?> active
          <?php elseif(request()->path() == 'user/cookie-alert'): ?> active
          <?php elseif(request()->path() == 'user/call-waiter'): ?> active
          <?php elseif(request()->path() == 'user/mail/information'): ?> active
          <?php elseif(request()->path() == 'user/email-templates'): ?> active
          <?php elseif(request()->routeIs('user.product.tags')): ?> active
          <?php elseif(request()->routeIs('user.email.editTemplate')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#basic">
              <i class="la flaticon-settings"></i>
              <p><?php echo e(__('Settings')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/favicon'): ?> show
            <?php elseif(request()->path() == 'user/logo'): ?> show
            <?php elseif(request()->path() == 'user/preloader'): ?> show
            <?php elseif(request()->path() == 'user/basic-info'): ?> show
            <?php elseif(request()->path() == 'user/support'): ?> show
            <?php elseif(request()->path() == 'user/social'): ?> show
            <?php elseif(request()->is('user/social/*')): ?> show
            <?php elseif(request()->path() == 'user/basic_settings/seo'): ?> show
            <?php elseif(request()->path() == 'user/breadcrumb'): ?> show
            <?php elseif(request()->path() == 'user/heading'): ?> show
            <?php elseif(request()->path() == 'user/plugins'): ?> show
            <?php elseif(request()->path() == 'user/seo'): ?> show
            <?php elseif(request()->path() == 'user/pwa'): ?> show
            <?php elseif(request()->path() == 'user/maintenance'): ?> show
            <?php elseif(request()->path() == 'user/cookie-alert'): ?> show
            <?php elseif(request()->path() == 'user/call-waiter'): ?> show
            <?php elseif(request()->path() == 'user/mail/information'): ?> show
            <?php elseif(request()->path() == 'user/email-templates'): ?> show
            <?php elseif(request()->routeIs('user.product.tags')): ?> show
            <?php elseif(request()->routeIs('user.email.editTemplate')): ?> show <?php endif; ?>"
              id="basic">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/favicon'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.favicon')); ?>">
                    <span class="sub-item"><?php echo e(__('Favicon')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/logo'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Logo')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/preloader'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.preloader')); ?>">
                    <span class="sub-item"><?php echo e(__('Preloader')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/basic-info'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.basic.info') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('General Settings')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#emailset"
                    aria-expanded="<?php echo e(request()->path() == 'user/mail/information' ||
                    request()->path() == 'user/email-templates' ||
                    request()->routeIs('user.email.editTemplate')
                        ? 'true'
                        : 'false'); ?>">
                    <span class="sub-item"><?php echo e(__('Email Settings')); ?></span>
                    <span class="caret"></span>
                  </a>
                  <div
                    class="collapse <?php echo e(request()->path() == 'user/mail/information' ||
                    request()->path() == 'user/email-templates' ||
                    request()->routeIs('user.email.editTemplate')
                        ? 'show'
                        : ''); ?>"
                    id="emailset">
                    <ul class="nav nav-collapse subnav">
                        
                      <li class="<?php if(request()->path() == 'user/mail/information'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('user.mail.info')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail Information')); ?></span>
                        </a>
                      </li>
                      <li
                        class="<?php if(request()->path() == 'user/email-templates'): ?> active
                                                <?php elseif(request()->routeIs('user.email.editTemplate')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('user.email.templates')); ?>">
                          <span class="sub-item"><?php echo e(__('Email Templates')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <?php if(!is_null($package) && !empty($permissions) && in_array('Call Waiter', $permissions)): ?>
                  <li class="<?php if(request()->path() == 'user/call-waiter'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.call.waiter')); ?>">
                      <span class="sub-item"><?php echo e(__('Call Waiter')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
                <li class="<?php if(request()->path() == 'user/support'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.support') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Support Informations')); ?></span>
                  </a>
                </li>
                <li
                  class="<?php if(request()->path() == 'user/social'): ?> active
                                    <?php elseif(request()->is('user/social/*')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.social.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Social Links')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/breadcrumb'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.breadcrumb')); ?>">
                    <span class="sub-item"><?php echo e(__('Breadcrumb')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/heading'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.heading') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Page Headings')); ?></span>
                  </a>
                </li>
                <?php if(!is_null($package) && !empty($permissions) && in_array('PWA Installability', $permissions)): ?>
                <li class="<?php if(request()->path() == 'user/pwa'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pwa')); ?>">
                    <span class="sub-item"><?php echo e(__('PWA Settings')); ?></span>
                  </a>
                </li>
                <?php endif; ?>
                <li class="<?php if(request()->path() == 'user/plugins'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.plugins')); ?>">
                    <span class="sub-item"><?php echo e(__('Plugins')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->path() == 'user/basic_settings/seo'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.basic_settings.seo', ['language' => $default->code])); ?>">
                    <span class="sub-item"><?php echo e(__('SEO Information')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->path() == 'user/maintenance'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.maintenance')); ?>">
                    <span class="sub-item"><?php echo e(__('Maintenance Mode')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/cookie-alert'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.cookie.alert') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Cookie Alert')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <?php elseif(!is_null($package) && (is_null(Auth::guard('web')->user()->admin_id)  || (is_array($roleBasedPermission) && in_array('Settings',$roleBasedPermission)))): ?>
           <li
            class="nav-item
          <?php if(request()->path() == 'user/favicon'): ?> active
          <?php elseif(request()->path() == 'user/logo'): ?> active
          <?php elseif(request()->path() == 'user/preloader'): ?> active
          <?php elseif(request()->path() == 'user/basic-info'): ?> active
          <?php elseif(request()->path() == 'user/support'): ?> active
          <?php elseif(request()->path() == 'user/social'): ?> active
          <?php elseif(request()->is('user/social/*')): ?> active
          <?php elseif(request()->path() == 'user/basic_settings/seo'): ?> active
          <?php elseif(request()->path() == 'user/breadcrumb'): ?> active
          <?php elseif(request()->path() == 'user/heading'): ?> active
          <?php elseif(request()->path() == 'user/plugins'): ?> active
          <?php elseif(request()->path() == 'user/seo'): ?> active
          <?php elseif(request()->path() == 'user/pwa'): ?> active
          <?php elseif(request()->path() == 'user/maintenance'): ?> active
          <?php elseif(request()->path() == 'user/cookie-alert'): ?> active
          <?php elseif(request()->path() == 'user/call-waiter'): ?> active
          <?php elseif(request()->path() == 'user/mail/information'): ?> active
          <?php elseif(request()->path() == 'user/email-templates'): ?> active
          <?php elseif(request()->routeIs('user.product.tags')): ?> active
          <?php elseif(request()->routeIs('user.email.editTemplate')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#basic">
              <i class="la flaticon-settings"></i>
              <p><?php echo e(__('Settings')); ?> </p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/favicon'): ?> show
            <?php elseif(request()->path() == 'user/logo'): ?> show
            <?php elseif(request()->path() == 'user/preloader'): ?> show
            <?php elseif(request()->path() == 'user/basic-info'): ?> show
            <?php elseif(request()->path() == 'user/support'): ?> show
            <?php elseif(request()->path() == 'user/social'): ?> show
            <?php elseif(request()->is('user/social/*')): ?> show
            <?php elseif(request()->path() == 'user/basic_settings/seo'): ?> show
            <?php elseif(request()->path() == 'user/breadcrumb'): ?> show
            <?php elseif(request()->path() == 'user/heading'): ?> show
            <?php elseif(request()->path() == 'user/plugins'): ?> show
            <?php elseif(request()->path() == 'user/seo'): ?> show
            <?php elseif(request()->path() == 'user/pwa'): ?> show
            <?php elseif(request()->path() == 'user/maintenance'): ?> show
            <?php elseif(request()->path() == 'user/cookie-alert'): ?> show
            <?php elseif(request()->path() == 'user/call-waiter'): ?> show
            <?php elseif(request()->path() == 'user/mail/information'): ?> show
            <?php elseif(request()->path() == 'user/email-templates'): ?> show
            <?php elseif(request()->routeIs('user.product.tags')): ?> show
            <?php elseif(request()->routeIs('user.email.editTemplate')): ?> show <?php endif; ?>"
              id="basic">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/favicon'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.favicon')); ?>">
                    <span class="sub-item"><?php echo e(__('Favicon')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/logo'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Logo')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/preloader'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.preloader')); ?>">
                    <span class="sub-item"><?php echo e(__('Preloader')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/basic-info'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.basic.info') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('General Settings')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#emailset"
                    aria-expanded="<?php echo e(request()->path() == 'user/mail/information' ||
                    request()->path() == 'user/email-templates' ||
                    request()->routeIs('user.email.editTemplate')
                        ? 'true'
                        : 'false'); ?>">
                    <span class="sub-item"><?php echo e(__('Email Settings')); ?></span>
                    <span class="caret"></span>
                  </a>
                  <div
                    class="collapse <?php echo e(request()->path() == 'user/mail/information' ||
                    request()->path() == 'user/email-templates' ||
                    request()->routeIs('user.email.editTemplate')
                        ? 'show'
                        : ''); ?>"
                    id="emailset">
                    <ul class="nav nav-collapse subnav">
                       
                      <li class="<?php if(request()->path() == 'user/mail/information'): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('user.mail.info')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail Information')); ?></span>
                        </a>
                      </li>
                      <li
                        class="<?php if(request()->path() == 'user/email-templates'): ?> active
                                                <?php elseif(request()->routeIs('user.email.editTemplate')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('user.email.templates')); ?>">
                          <span class="sub-item"><?php echo e(__('Email Templates')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <?php if(!is_null($package) && !empty($permissions) && in_array('Call Waiter', $permissions)): ?>
                  <li class="<?php if(request()->path() == 'user/call-waiter'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.call.waiter')); ?>">
                      <span class="sub-item"><?php echo e(__('Call Waiter')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
                <li class="<?php if(request()->path() == 'user/support'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.support') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Support Informations')); ?></span>
                  </a>
                </li>
                <li
                  class="<?php if(request()->path() == 'user/social'): ?> active
                                    <?php elseif(request()->is('user/social/*')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.social.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Social Links')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/breadcrumb'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.breadcrumb')); ?>">
                    <span class="sub-item"><?php echo e(__('Breadcrumb')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/heading'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.heading') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Page Headings')); ?></span>
                  </a>
                </li>
                <?php if(!is_null($package) && !empty($permissions) && in_array('PWA Installability', $permissions)): ?>
                <li class="<?php if(request()->path() == 'user/pwa'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pwa')); ?>">
                    <span class="sub-item"><?php echo e(__('PWA Settings')); ?></span>
                  </a>
                </li>
                <?php endif; ?>

                <li class="<?php if(request()->path() == 'user/plugins'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.plugins')); ?>">
                    <span class="sub-item"><?php echo e(__('Plugins')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->path() == 'user/basic_settings/seo'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.basic_settings.seo', ['language' => $default->code])); ?>">
                    <span class="sub-item"><?php echo e(__('SEO Information')); ?></span>
                  </a>
                </li>

                <li class="<?php if(request()->path() == 'user/maintenance'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.maintenance')); ?>">
                    <span class="sub-item"><?php echo e(__('Maintenance Mode')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/cookie-alert'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.cookie.alert') . '?language=' . $default->code); ?>">
                    <span class="sub-item"><?php echo e(__('Cookie Alert')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
   

        <?php if(
            (!is_null($package) &&
                !empty($permissions) &&
               ( is_null(Auth::guard('web')->user()->admin_id)) || (is_array($roleBasedPermission) && in_array('Push Notification', $roleBasedPermission)))
              ): ?>
          <li
            class="nav-item
          <?php if(request()->path() == 'user/pushnotification/settings'): ?> active
          <?php elseif(request()->path() == 'user/pushnotification/send'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#pushNotification">
              <i class="far fa-bell"></i>
              <p><?php echo e(__('Push Notification')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/pushnotification/settings'): ?> show
            <?php elseif(request()->path() == 'user/pushnotification/send'): ?> show <?php endif; ?>"
              id="pushNotification">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/pushnotification/settings'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pushnotification.settings')); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/pushnotification/send'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.pushnotification.send')); ?>">
                    <span class="sub-item"><?php echo e(__('Send Notification')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
      
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Subscribers', $roleBasedPermission)))): ?>
          <li
            class="nav-item
                <?php if(request()->path() == 'user/subscribers'): ?> active
                <?php elseif(request()->path() == 'user/mail/subscriber'): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#subscribers">
              <i class="la flaticon-envelope"></i>
              <p><?php echo e(__('Subscribers')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
                    <?php if(request()->path() == 'user/subscribers'): ?> show
                    <?php elseif(request()->path() == 'user/mail/subscriber'): ?> show <?php endif; ?>"
              id="subscribers">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->path() == 'user/subscribers'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.subscriber.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Subscribers')); ?></span>
                  </a>
                </li>
                <li class="<?php if(request()->path() == 'user/mail/subscriber'): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.mail.subscriber')); ?>">
                    <span class="sub-item"><?php echo e(__('Mail to Subscribers')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
        <?php if(
            !is_null($package) &&
                (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Announcement Popups', $roleBasedPermission)))): ?>
         
          <li
            class="nav-item <?php if(request()->routeIs('user.announcement_popups')): ?> active
                    <?php elseif(request()->routeIs('user.announcement_popups.select_popup_type')): ?> active
                    <?php elseif(request()->routeIs('user.announcement_popups.create_popup')): ?> active
                    <?php elseif(request()->routeIs('user.announcement_popups.edit_popup')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.announcement_popups', ['language' => $default->code])); ?>">
              <i class="fas fa-bullhorn"></i>
              <p><?php echo e(__('Announcement Popups')); ?></p>
            </a>
          </li>
        <?php endif; ?>
      
        <?php if(
            !is_null($package) &&
                ((is_null(Auth::guard('web')->user()->admin_id) && in_array('Staffs', $permissions)) ||
                    (is_array($roleBasedPermission) && in_array('Staffs Management', $roleBasedPermission)))): ?>
          <li
            class="nav-item
          <?php if(request()->path() == 'user/roles'): ?> active
          <?php elseif(request()->is('user/role/*/permissions/manage')): ?> active
          <?php elseif(request()->path() == 'user/admins'): ?> active
          <?php elseif(request()->is('user/admin/*/edit')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#adminsManagement">
              <i class="fas fa-users-cog"></i>
              <p><?php echo e(__('Staffs Management')); ?></p>
              <span class="caret"></span>
            </a>
            <div
              class="collapse
            <?php if(request()->path() == 'user/roles'): ?> show
            <?php elseif(request()->is('user/role/*/permissions/manage')): ?> show
            <?php elseif(request()->path() == 'user/admins'): ?> show
            <?php elseif(request()->is('user/admin/*/edit')): ?> show <?php endif; ?>"
              id="adminsManagement">
              <ul class="nav nav-collapse">
                <li
                  class="
                <?php if(request()->path() == 'user/roles'): ?> active
                <?php elseif(request()->is('user/role/*/permissions/manage')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.role.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Role Management')); ?></span>
                  </a>
                </li>
                <li
                  class="
                <?php if(request()->path() == 'user/admins'): ?> active
                <?php elseif(request()->is('user/admin/*/edit')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('user.admin.index')); ?>">
                    <span class="sub-item"><?php echo e(__('Staffs')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>


        <?php if(!is_null($package) && (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Customers', $roleBasedPermission)))): ?>
        <li
          class="nav-item
          <?php if(request()->path() == 'user/customers'): ?>  active
          <?php elseif(request()->path() == 'user/registered-client'): ?> active <?php endif; ?>">
          <a data-toggle="collapse" href="#customers">
            <i class="la flaticon-users"></i>
            <p><?php echo e(__('Customers')); ?></p>
            <span class="caret"></span>
          </a>
          <div
            class="collapse
            <?php if(request()->path() == 'user/customers'): ?> show
            <?php elseif(request()->path() == 'user/registered-client'): ?> show
            <?php endif; ?>"
            id="customers">
            <ul class="nav nav-collapse">
              <li class="nav-item
                <?php if(request()->path() == 'user/customers'): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('user.customer.index')); ?>">
                  <p><?php echo e(__('Customers')); ?></p>
                </a>
              </li>
              <?php if(in_array('Online Order',$packagePermissions)): ?>
              <li class="nav-item
            <?php if(request()->path() == 'user/registered-client'): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('user.registered_clients')); ?>">
                  <p><?php echo e(__('Registered Customers')); ?></p>
                </a>
              </li>
               <?php endif; ?>
            </ul>
          </div>
        </li>
       <?php endif; ?>

    
        <?php if(!is_null($package) && (is_null(Auth::guard('web')->user()->admin_id) || (is_array($roleBasedPermission) && in_array('Sitemap', $roleBasedPermission)))): ?>
          <li class="nav-item
                    <?php if(request()->path() == 'user/sitemap'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.sitemap.index') . '?language=' . $default->code); ?>">
              <i class="fa fa-sitemap"></i>
              <p><?php echo e(__('Sitemap')); ?></p>
            </a>
          </li>
        <?php endif; ?>
        <?php if(is_null(Auth::guard('web')->user()->admin_id)): ?>
          <li
            class="nav-item
                    <?php if(request()->path() == 'user/package-list'): ?> active
                    <?php elseif(request()->is('user/package/checkout/*')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.plan.extend.index')); ?>">
              <i class="fas fa-file-invoice-dollar"></i>
              <p><?php echo e(__('Buy Plan')); ?></p>
            </a>
          </li>
        <?php endif; ?>
        <?php if(is_null(Auth::guard('web')->user()->admin_id)): ?>
          <li class="nav-item
                    <?php if(request()->path() == 'user/payment-log'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.payment-log.index')); ?>">
              <i class="fas fa-list-ol"></i>
              <p><?php echo e(__('Payment Logs')); ?></p>
            </a>
          </li>
        <?php endif; ?>
        <?php if(!is_null($package)): ?>
          <li class="nav-item
                <?php if(request()->path() == 'user/profile/edit'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.edit.profile')); ?>">
              <i class="far fa-user-circle"></i>
              <p><?php echo e(__('Edit Profile')); ?></p>
            </a>
          </li>
          <li class="nav-item <?php if(request()->path() == 'user/change-password'): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('user.change.password')); ?>">
              <i class="fas fa-key"></i>
              <p><?php echo e(__('Change Password')); ?></p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/side-navbar.blade.php ENDPATH**/ ?>