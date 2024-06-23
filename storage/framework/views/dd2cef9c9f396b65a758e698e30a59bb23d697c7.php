<?php use App\Constants\Constant;use App\Http\Helpers\Uploader;use App\Models\User\Product;use App\Models\User\ProductInformation; ?>
<div class="row no-gutters">
    <?php if(count($pcats) === 0): ?>
        <div class="col-lg-12">
            <h5 class="text-center">NO PRODUCT FOUND</h5>
        </div>
    <?php else: ?>
        <div class="col-lg-12">
            <div class="pos-items">
                <div class="card">
                    <div class="card-body px-2 pb-1">
                        <div class="row no-gutters">
                            <?php $__currentLoopData = $pcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($pcat->productInformation()->count() > 0): ?>
                                    <?php $__currentLoopData = $pcat->productInformation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productInformation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $product = Product::query()->find($productInformation->product_id);
                                            $pI = ProductInformation::query()->where('product_id', $product->id)->where('language_id',$lang->id)->first();
                                        ?>
                                        <div class="col-lg-3 px-2 mb-3 pos-item"
                                             data-title="<?php echo e($productInformation->title); ?>">
                                            <a href="#" class="single-pos-item d-block cart-link"
                                               data-product="<?php echo e($product); ?>"
                                               data-href="<?php echo e(route('user.add.cart',$product->id)); ?>">
                                                <img class="lazy"
                                                     src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$product->feature_image,$userBs)); ?>"
                                                     data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$product->feature_image,$userBs)); ?>"
                                                      width="120" height="120">
                                                <h6 class="text-white mt-2 text-center">
                                                     <?php echo e(strlen($productInformation->title) > 27 ? mb_substr($productInformation->title, 0, 27, 'UTF-8') . '...' : $productInformation->title); ?>

                                                </h6>
                                                
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/partials/items.blade.php ENDPATH**/ ?>