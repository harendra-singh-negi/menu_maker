<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Language;
    use Illuminate\Support\Facades\Auth;
?>



<?php if ($__env->exists('user.partials.rtl-style')) echo $__env->make('user.partials.rtl-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Items</h4>
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
                <a href="#">Items Management</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Items</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">Items</div>
                        </div>
                        <div class="col-lg-3">
                            <?php if(!empty($userLangs)): ?>
                                <select name="language" class="form-control"
                                    onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
                                    <option value="" selected disabled>Select a Language</option>
                                    <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>"
                                            <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>>
                                            <?php echo e($lang->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                            <a href="<?php echo e(route('user.product.create') . '?language=' . request()->input('language')); ?>"
                                class="btn btn-primary float-right btn-sm"><i class="fas fa-plus"></i> Add Item</a>
                            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
                                data-href="<?php echo e(route('user.product.bulk.delete')); ?>"><i class="flaticon-interface-5"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($products) == 0): ?>
                                <h3 class="text-center">NO PRODUCT FOUND</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col">Image</th>
                                                <th scope="col" width="35%">Title</th>
                                                <th scope="col">Price (<?php echo e($userBe->base_currency_text); ?>)</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Featured</th>
                                                <th scope="col">Special</th>
                                                <th scope="col" width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($product->id); ?>">
                                                    </td>
                                                    <td>
                                                        <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $product->feature_image, $userBs)); ?>"
                                                            width="80" height="80">
                                                    </td>
                                                    <td width="35%"> <a
                                                            href="<?php echo e(route('user.front.product.details', [$tusername, $product->slug, $product->id])); ?>"
                                                            target="_blank"><?php echo e(strlen($product->title) > 120 ? substr($product->title, 0, 120) . '...' : $product->title); ?></a>
                                                    </td>
                                                    <td>

                                                        <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                        <?php echo e($product->current_price); ?>

                                                        <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>


                                                    </td>
                                                    <td>
                                                        <?php if(!empty($product->category_name)): ?>
                                                            <?php echo e(convertUtf8($product->category_name)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form id="featureForm<?php echo e($product->id); ?>"
                                                            action="<?php echo e(route('user.product.feature')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="product_id"
                                                                value="<?php echo e($product->id); ?>">
                                                            <select name="feature" id=""
                                                                class="form-control-sm text-white
                                  <?php if($product->is_feature == 1): ?> bg-success
                                  <?php elseif($product->is_feature == 0): ?>
                                  bg-danger <?php endif; ?>
                                "
                                                                onchange="document.getElementById('featureForm<?php echo e($product->id); ?>').submit();">
                                                                <option value="1"
                                                                    <?php echo e($product->is_feature == 1 ? 'selected' : ''); ?>>
                                                                    Yes
                                                                </option>
                                                                <option value="0"
                                                                    <?php echo e($product->is_feature == 0 ? 'selected' : ''); ?>>
                                                                    No
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form id="specialForm<?php echo e($product->id); ?>"
                                                            action="<?php echo e(route('user.product.special')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="product_id"
                                                                value="<?php echo e($product->id); ?>">
                                                            <select name="special" id=""
                                                                class="form-control-sm text-white
                                  <?php if($product->is_special == 1): ?> bg-success
                                  <?php elseif($product->is_special == 0): ?>
                                  bg-danger <?php endif; ?>
                                "
                                                                onchange="document.getElementById('specialForm<?php echo e($product->id); ?>').submit();">
                                                                <option value="1"
                                                                    <?php echo e($product->is_special == 1 ? 'selected' : ''); ?>>
                                                                    Yes
                                                                </option>
                                                                <option value="0"
                                                                    <?php echo e($product->is_special == 0 ? 'selected' : ''); ?>>
                                                                    No
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td width="15%">
                                                        <a class="btn btn-secondary my-2 btn-sm p-2"
                                                            href="<?php echo e(route('user.product.edit', $product->id) . '?language=' . request()->input('language')); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form class="deleteform d-inline-block"
                                                            action="<?php echo e(route('user.product.delete')); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="product_id"
                                                                value="<?php echo e($product->id); ?>">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm deletebtn p-2">
                                                                <i class="fas fa-trash"></i>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/product/index.blade.php ENDPATH**/ ?>