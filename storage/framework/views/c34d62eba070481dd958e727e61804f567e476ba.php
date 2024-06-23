<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;use App\Models\User\Product;use App\Models\User\ProductInformation;
?>

<div class="row no-gutters">
    <?php if(count($pcats)=== 0): ?>
        <div class="col-lg-12">
            <h5 class="text-center">NO CATEGORY FOUND</h5>
        </div>
    <?php else: ?>
        <div class="col-lg-4 pr-3">
            <div class="pos-categories">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd"
                             id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
                            <?php $__currentLoopData = $pcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="pcat<?php echo e($pcat->id); ?>-tab"
                                   data-toggle="pill" href="#pcat<?php echo e($pcat->id); ?>" role="tab"
                                   aria-controls="pcat<?php echo e($pcat->id); ?>" aria-selected="false"><?php echo e($pcat->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="pos-items">
                <div class="card">
                    <div class="card-body px-2 pb-1">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php $__currentLoopData = $pcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="pcat<?php echo e($pcat->id); ?>"
                                     role="tabpanel" aria-labelledby="pcat<?php echo e($pcat->id); ?>-tab">
                                    <?php if($pcat->productInformation()->count() > 0): ?>
                                        <div class="row no-gutters">
                                            <?php $__currentLoopData = $pcat->productInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productInformation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $product = Product::query()->find($productInformation->product_id);
                                                ?>
                                                <div class="col-lg-4 px-2 mb-3">
                                                    <a href="#" class="single-pos-item d-block cart-link"
                                                       data-product="<?php echo e($product); ?>"
                                                       data-title="<?php echo e($productInformation->title); ?>"
                                                       data-href="<?php echo e(route('user.add.cart',$product->id)); ?>">
                                                        <img class="lazy"
                                                             src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$product->feature_image,$userBs)); ?>"
                                                             data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$product->feature_image,$userBs)); ?>"
                                                              width="120" height="120">
                                                        <h6 class="mt-2 text-center">
                                                            <?php echo e(strlen($productInformation->title) > 27 ? mb_substr($productInformation->title, 0, 27, 'UTF-8') . '...' : $productInformation->title); ?>

                                                        </h6>
                                                         <p class="mt-2 text-center">
                                                           
                                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($product->current_price); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                            
                                                            <?php if($product->previous_price): ?>
                                                            <del>
                                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($product->previous_price); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                            </del>
                                                            <?php endif; ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/partials/cats-items.blade.php ENDPATH**/ ?>