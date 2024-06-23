<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
    use App\Models\User\Product;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Models\User\ProductReview;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['Home'] ?? __('Home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .good-food-area::before {
    position: absolute;
    content: '';
    right: 0;
    top: 0;
    width: 39%;
    height: 100%;
    background-image: url("<?php echo e($userBe->special_section_bg ? Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->special_section_bg, $userBs) : asset('assets/front/img/good-food-shape.png')); ?>");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: right;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('meta-keywords', !empty($userSeo) ? $userSeo->home_meta_keywords : ''); ?>
<?php $__env->startSection('meta-description', !empty($userSeo) ? $userSeo->home_meta_description : ''); ?>

<?php $__env->startSection('content'); ?>

        <?php if ($__env->exists('user-front.hero.slider')) echo $__env->make('user-front.hero.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="fress-area" style="<?php if($userBs->feature_section == 0): ?> padding-bottom: 0; <?php endif; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if($userBs->home_version == 'slider'): ?>
                            <?php if(!empty($userBe->slider_bottom_img)): ?>
                                <div class="fress-thumb text-center mb-90">
                                    <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->slider_bottom_img, $userBs)); ?>"
                                        alt="fress">
                                </div>
                            <?php else: ?>
                             <div class="fress-thumb text-center mb-90">
                                <img src="<?php echo e(asset('assets/restaurant/images/bottomimg.png')); ?>" alt="fress">
                             </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if(!empty($userBe->hero_bottom_img)): ?>
                                <div class="fress-thumb text-center mb-90">
                                    <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->hero_bottom_img, $userBs)); ?>"
                                        alt="fress">
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                  <?php if($userBs->feature_section == 1): ?>
                <div class="row fress-active <?php echo e(!empty($bottomImg) ? '' : 'pt-120'); ?>">
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3">
                            <div class="single-fress white-bg text-center">
                                <?php if(!empty($feature->image)): ?>
                                    <img class="lazy wow fadeIn"
                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_FEATURE_IMAGES, $feature->image, $userBs)); ?>"
                                        data-wow-delay="1s" data-wow-duration="1s" alt="feature">
                                <?php endif; ?>
                                <a href="javascript:;"><?php echo e(convertUtf8($feature->title)); ?></a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="fress-shape">
                <?php if($userBs->home_version == 'slider'): ?>
                    <?php if(!empty($userBe->slider_shape_img)): ?>
                        <img class="lazy"
                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->slider_shape_img, $userBs)); ?>"
                            alt="shape">
                     <?php else: ?>
                        <img class="lazy"
                            data-src="<?php echo e(asset('assets/restaurant/images/shape.png')); ?>"
                            alt="shape">
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(!empty($userBe->hero_shape_img)): ?>
                        <img class="lazy"
                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->hero_shape_img, $userBs)); ?>"
                            alt="shape">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    <?php if($userBs->intro_section == 1): ?>
        <section class="experience-area">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-lg-6 col-md-8">
                        <div class="experience-content">
                            <?php if($userBs->intro_section_title): ?>
                                <div class="flag"><span><?php echo e(convertUtf8($userBs->intro_section_title)); ?></span></div>
                            <?php endif; ?>
                            <h3 class="title wow fadeIn" data-wow-duration="2000ms" data-wow-delay="0ms">
                                <?php echo e(convertUtf8($userBs->intro_title)); ?></h3>
                            <p class=" wow fadeIns" data-wow-duration="2000ms" data-wow-delay="300ms">
                                <?php echo e(convertUtf8($userBs->intro_text)); ?></p>

                            <?php if(!empty($userBs->intro_signature)): ?>
                                <img class="lazy wow fadeIn" data-wow-duration="2000ms" data-wow-delay="600ms"
                                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_signature, $userBs)); ?>"
                                    alt="autograph">
                            <?php else: ?>

                            <?php endif; ?>
                            <i class="flaticon-burger"></i>
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <?php if($userBs->intro_contact_text && $userBs->intro_contact_number): ?>
                        <div class="col-lg-4 col-md-7">
                            <div class="experience-contact mb-50 wow fadeIn animated" data-wow-duration="2000ms"
                                data-wow-delay="300ms">
                                <span><?php echo e(convertUtf8($userBs->intro_contact_text)); ?></span>
                                <p><?php echo e(convertUtf8($userBs->intro_contact_number)); ?></p>
                                <i class="flaticon-phone-call"></i>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($userBs->intro_video_image && $userBs->intro_video_link): ?>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-7">

                            <div class="experience-play-item mt-70">

                                <?php if($userBs->intro_video_image): ?>
                                    <img class="lazy wow fadeIn"
                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_video_image, $userBs)); ?>"
                                        alt="experience">
                                <?php endif; ?>
                                <div class="experience-overlay">
                                    <a class="video-popup" href="<?php echo e($userBs->intro_video_link); ?>"><i
                                            class="flaticon-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($userBs->intro_main_image): ?>
                <div class="experience-bg">
                    <img class="lazy wow fadeIn"
                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->intro_main_image, $userBs)); ?>"
                        alt="experience">
                </div>
            <?php else: ?>

            <?php endif; ?>

        </section>
    <?php endif; ?>

    <?php if($userBs->menu_section == 1): ?>
        <?php if($userBe->menu_version == 1): ?>
            <section class="food-menu-area food-menu-2-area food-menu-3-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span><?php echo e(convertUtf8($sectionHeading?->menu_title)); ?>

                                    <img class="lazy" data-src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>"
                                        alt=""></span>
                                <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->menu_subtitle)); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $featureProductCount = Product::query()
                                                ->join('product_informations', 'product_informations.product_id', 'products.id')
                                                ->where('product_informations.category_id', $category->id)
                                                ->where('products.is_feature', 1)
                                                ->where('products.user_id', $user->id)
                                                ->count();
                                        ?>
                                        <li class="nav-item">

                                            <a class="nav-link <?php echo e($keys == 0 ? 'active' : ''); ?>"
                                                id="<?php echo e($category->slug); ?>-tab" data-toggle="pill"
                                                href="#<?php echo e($category->slug); ?>" role="tab"
                                                aria-controls="<?php echo e($category->slug); ?>" aria-selected="true">
                                                <?php if(!empty($category->image)): ?>
                                                    <img class="lazy wow fadeIn"
                                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_CATEGORY_IMAGE, $category->image, $userBs)); ?>"
                                                        data-wow-delay=".5s" alt="menu">
                                                <?php endif; ?>
                                                <input type="hidden" value="<?php echo e($category->id); ?>" class="id">
                                                <p <?php if(empty($category->image)): ?> style="padding-top: 0;" <?php endif; ?>>
                                                    <?php echo e(convertUtf8($category->name)); ?>

                                                    (<?php echo e($featureProductCount); ?>)
                                                </p>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>"
                                        id="<?php echo e($category->slug); ?>" role="tabpanel"
                                        aria-labelledby="<?php echo e($category->slug); ?>-tab">

                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*"
                                                <?php if($category->subcategories()->where('is_feature', 1)->where('user_id', $user->id)->count() == 0): ?> style="display:none;" <?php endif; ?>><?php echo e($keywords['All'] ?? __('All')); ?></button>
                                            <?php $__currentLoopData = $category->subcategories()->where('is_feature', 1)->where('user_id', $user->id)->where('language_id',$userCurrentLang->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <button class="button"
                                                    data-filter=".sub<?php echo e($subcat->id); ?>"><?php echo e($subcat->name); ?></button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="food-items-loader">
                                                <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
                                            </div>
                                            <?php
                                                $featureActiveProducts = Product::query()
                                                    ->join('product_informations', 'product_informations.product_id', 'products.id')
                                                    ->where('product_informations.category_id', $category->id)
                                                    ->where('products.is_feature', 1)
                                                    ->where('products.user_id', $user->id)
                                                    ->where('products.status', 1)
                                                    ->get();
                                            ?>
                                            <?php if(count($featureActiveProducts) > 0): ?>
                                                <?php $__currentLoopData = $featureActiveProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-lg-6">
                                                        <div class="food-menu-items">
                                                            <div
                                                                class="single-menu-item mt-30 sub<?php echo e($product->subcategory_id); ?>">
                                                                <div class="item-details">
                                                                    <div class="menu-thumb">
                                                                        <img class="lazy wow fadeIn"
                                                                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $product->feature_image, $userBs)); ?>"
                                                                            alt="menu" data-wow-delay=".5s">
                                                                        <div class="thumb-overlay">
                                                                            <a
                                                                                href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"><i
                                                                                    class="flaticon-add"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="menu-content ml-30">

                                                                        <a class="title"
                                                                            href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"><?php echo e(convertUtf8($product->title)); ?>

                                                                        </a>
                                                                          <?php if(in_array('Online Order', $packagePermissions)): ?>
                                                                    <div class="rate mt-1">
                                                                        <div class="rating"
                                                                            style="width:<?php echo e(!empty($product->product_reviews)? ProductReview::where('user_id', $user->id)->where('product_id', $product->product_id)->avg('review') * 20: 0); ?>%">
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                        <p>
                                                                            <?php echo e(convertUtf8(strlen($product->summary)) > 70 ? convertUtf8(substr($product->summary, 0, 70)) . '...' : convertUtf8($product->summary)); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="menu-price-btn">
                                                                    <?php if(in_array('Online Order', $packagePermissions)): ?>
                                                                        <a class="cart-link d-md-none d-block btn mobile"
                                                                            data-product="<?php echo e($product); ?>"
                                                                            data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>">+</a>
                                                                        <a class="cart-link d-none d-md-block"
                                                                            data-product="<?php echo e($product); ?>"
                                                                            data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Add to Cart'] ?? __('Add to Cart')); ?>

                                                                        </a>
                                                                        <span><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                        </span>
                                                                        <?php if(convertUtf8($product->previous_price)): ?>
                                                                            <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <?php if(!empty(json_decode($product->addons, true)) || !empty(json_decode($product->variations, true))): ?>
                                                                            <a class="main-btn cart-link show"
                                                                                data-product="<?php echo e($product); ?>"
                                                                                data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Extras'] ?? __('Extras')); ?>

                                                                            </a>
                                                                            <span class="hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                            </span>
                                                                            <?php if(convertUtf8($product->previous_price)): ?>
                                                                                <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                            <a class="main-btn hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                            </a>
                                                                            <span class="show"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                            </span>
                                                                            <?php if(convertUtf8($product->previous_price)): ?>
                                                                                <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if($product->is_special == 1): ?>
                                                                    <div class="flag flag-2">
                                                                        <span><?php echo e(__('Special')); ?></span>
                                                                    </div>
                                                                <?php endif; ?>

                                                            </div>


                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-lg-12">
                                                    <div class="menu-more-btn text-center mt-40">
                                                        <a
                                                            href="<?php echo e(route('user.front.items', getParam())); ?>"><?php echo e($keywords['View All Items'] ?? __('View All Items')); ?></a>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">
                                                        <?php echo e($keywords['Product Not Found'] ?? __('Product Not Found')); ?></h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <?php if(!empty($userBe->menu_section_img)): ?>
                <style>
                    .food-menu-area .food-menu-items.menu-2::before {
                        background-image: url("<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->menu_section_img, $userBs)); ?>");
                    }
                </style>
            <?php endif; ?>
            <section class="food-menu-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span><?php echo e(convertUtf8($userBe->menu_section_title)); ?>

                                    <img src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>" alt="">
                                </span>
                                <h3 class="title"><?php echo e(convertUtf8($userBe->menu_section_subtitle)); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $featureProductCount = Product::query()
                                                ->join('product_informations', 'product_informations.product_id', 'products.id')
                                                ->where('product_informations.category_id', $category->id)
                                                ->where('products.is_feature', 1)
                                                ->where('products.user_id', $user->id)
                                                ->count();
                                        ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?php echo e($keys == 0 ? 'active' : ''); ?>"
                                                id="<?php echo e(convertUtf8($category->slug)); ?>-tab" data-toggle="pill"
                                                href="#<?php echo e(convertUtf8($category->slug)); ?>" role="tab"
                                                aria-controls="<?php echo e(convertUtf8($category->slug)); ?>" aria-selected="true">
                                                <?php if(!empty($category->image)): ?>
                                                    <img class="lazy wow fadeIn"
                                                        src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_CATEGORY_IMAGE, $category->image, $userBs)); ?>"
                                                        data-wow-delay=".5s" alt="menu">
                                                <?php endif; ?>
                                                <p <?php if(empty($category->image)): ?> style="padding-top: 0;" <?php endif; ?>>
                                                    <?php echo e(convertUtf8($category->name)); ?>

                                                    (<?php echo e($featureProductCount); ?>)
                                                </p>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php echo e($key == 0 ? 'show active' : ''); ?>"
                                        id="<?php echo e(convertUtf8($category->slug)); ?>" role="tabpanel"
                                        aria-labelledby="<?php echo e(convertUtf8($category->slug)); ?>-tab">

                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*"
                                                <?php if($category->subcategories()->where('is_feature', 1)->where('user_id', $user->id)->count() == 0): ?> style="display:none;" <?php endif; ?>>
                                                <?php echo e(__('All')); ?>

                                            </button>
                                            <?php $__currentLoopData = $category->subcategories()->where('is_feature', 1)->where('user_id', $user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <button class="button"
                                                    data-filter=".sub<?php echo e($subcat->id); ?>"><?php echo e($subcat->name); ?></button>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <div class="food-menu-items menu-2">


                                            <div class="food-items-loader">
                                                <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
                                            </div>

                                            <?php
                                                $featureActiveProducts = Product::query()
                                                    ->join('product_informations', 'product_informations.product_id', 'products.id')
                                                    ->where('product_informations.category_id', $category->id)
                                                    ->where('products.is_feature', 1)
                                                    ->where('products.user_id', $user->id)
                                                    ->where('products.status', 1)
                                                    ->get();
                                            ?>
                                            <?php if(count($featureActiveProducts) > 0): ?>
                                                <?php $__currentLoopData = $featureActiveProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="single-menu-item mt-30 sub<?php echo e($product->subcategory_id); ?>">
                                                        <div class="menu-thumb">
                                                            <img class="lazy wow fadeIn"
                                                                data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $product->feature_image, $userBs)); ?>"
                                                                data-wow-delay=".5s" alt="menu">
                                                            <div class="thumb-overlay">
                                                                <a
                                                                    href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>">
                                                                    <i class="flaticon-add"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="menu-content ml-30">
                                                            <a class="title"
                                                                href="<?php echo e(route('user.front.product.details', [getParam(), $product->slug, $product->product_id])); ?>"><?php echo e(convertUtf8($product->title)); ?></a>
                                                            <p>
                                                                <?php echo e(convertUtf8(strlen($product->summary)) > 180 ? convertUtf8(substr($product->summary, 0, 180)) . '...' : convertUtf8($product->summary)); ?>

                                                            </p>
                                                        </div>
                                                        <div class="menu-price-btn menu-2">
                                                            <?php if(in_array('Online Order', $packagePermissions)): ?>
                                                                <a class="cart-link d-md-none d-block btn mobile"
                                                                    data-product="<?php echo e($product); ?>"
                                                                    data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>">+</a>
                                                                <a class="cart-link d-none d-md-block"
                                                                    data-product="<?php echo e($product); ?>"
                                                                    data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Add to Cart'] ?? __('Add to Cart')); ?>

                                                                </a>
                                                                <span><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                </span>
                                                                <?php if(convertUtf8($product->previous_price)): ?>
                                                                    <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if(!empty(json_decode($product->addons, true)) || !empty(json_decode($product->variations, true))): ?>
                                                                    <a class="main-btn cart-link show"
                                                                        data-product="<?php echo e($product); ?>"
                                                                        data-href="<?php echo e(route('user.front.add.cart', [getParam(), $product->product_id])); ?>"><?php echo e($keywords['Extras'] ?? __('Extras')); ?>

                                                                    </a>
                                                                    <span class="hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </span>
                                                                    <?php if(convertUtf8($product->previous_price)): ?>
                                                                        <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <a class="main-btn hide"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </a>
                                                                    <span class="show"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                    </span>
                                                                    <?php if(convertUtf8($product->previous_price)): ?>
                                                                        <del> <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($product->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($product->is_special == 1): ?>
                                                            <div class="flag flag-2"><span><?php echo e(__('Special')); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">
                                                        <?php echo e($keywords['Product Not Found'] ?? __('Product Not Found')); ?>

                                                    </h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="menu-more-btn text-center mt-75">
                                                    <a
                                                        href="<?php echo e(route('user.front.items', [getParam(), 'category_id' => $category->id])); ?>"><?php echo e(__('View All Items')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($userBs->special_section == 1): ?>
        <section class="good-food-area pt-180 pb-120 gray-bg">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8">
                        <div class="special-items">
                            <?php if($special_product->count() > 0): ?>
                                <?php $__currentLoopData = $special_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="good-food-item white-bg text-center">
                                        <div class="food-shape">
                                          <img class="food-shape-img" src="<?php echo e(asset('assets/tenant/img/special_shape.png')); ?>" >
                                        </div>
                                        
                                        <h3 class="title">
                                            <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($sproduct->current_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                        </h3>
                                        <?php if(!empty(convertUtf8($sproduct->previous_price))): ?>
                                            <del class="preprice"><?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e(convertUtf8($sproduct->previous_price)); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?></del>
                                        <?php endif; ?>
                                        <div class="rate mx-auto mt-3">
                                            <div class="rating"
                                                style="width:<?php echo e(!empty($product->product_reviews)? ProductReview::where('user_id', $user->id)->where('product_id', $product->product_id)->avg('review') * 20: 0); ?>%">
                                            </div>
                                        </div>
                                        <a class="title"
                                            href="<?php echo e(route('user.front.product.details', [getParam(), $sproduct->slug, $sproduct->product_id])); ?>"><?php echo e(convertUtf8($sproduct->title)); ?></a>
                                        <p>
                                            <?php echo e(convertUtf8(strlen($sproduct->summary)) > 70 ? convertUtf8(substr($sproduct->summary, 0, 70)) . '...' : convertUtf8($sproduct->summary)); ?>

                                        </p>
                                        <img class="lazy wow fadeIn"
                                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE, $sproduct->feature_image, $userBs)); ?>"
                                            alt="">
                                        <div class="special-btns">
                                            <a class="cart-link" data-product="<?php echo e($sproduct); ?>"
                                                data-href="<?php echo e(route('user.front.add.cart', [getParam(), $sproduct->product_id])); ?>"><?php echo e($keywords['Add to Cart'] ?? __('Add to Cart')); ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <h3><?php echo e($keywords['NO SPECIAL PRODUCT FOUND!'] ?? __('NO SPECIAL PRODUCT FOUND!')); ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="menu-list-content text-right d-none d-lg-block">
                            <?php
                                $parts = preg_split('/\s+/', convertUtf8($userBe->special_section_title));
                            ?>
                            <ul>
                                <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e(convertUtf8($part)); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <a href="<?php echo e(route('user.front.product', getParam())); ?>"><span><?php echo e(convertUtf8($userBe->special_section_subtitle)); ?></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($userBs->team_section == 1): ?>
        <section class="team-area" style="<?php echo e($members->count() == 0 ? 'background:#f1f1f1' : ''); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="section-title text-center">
                            <span><?php echo e(convertUtf8($sectionHeading?->team_title)); ?> <img
                                    src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>" alt=""></span>
                            <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->team_subtitle)); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php if($members->count() > 0): ?>
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="single-team mt-30">
                                    <div class="team-thumb">
                                        <?php if($member->image): ?>
                                            <img class="lazy wow fadeIn"
                                                data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_MEMBER_IMAGES, $member->image, $userBs)); ?>"
                                                data-wow-delay=".5s" data-wow-duration="1s" alt="team">
                                        <?php endif; ?>
                                        <div class="team-overlay">
                                            <div class="link">
                                                <a><i class="flaticon-add"></i></a>
                                            </div>
                                            <div class="social">
                                                <ul>
                                                    <?php if($member->facebook): ?>
                                                        <li><a href="<?php echo e($member->facebook); ?>"><i
                                                                    class="flaticon-facebook"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->twitter): ?>
                                                        <li><a href="<?php echo e($member->twitter); ?>"><i
                                                                    class="flaticon-twitter"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->instagram): ?>
                                                        <li><a href="<?php echo e($member->instagram); ?>"><i
                                                                    class="flaticon-instagram"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if($member->linkedin): ?>
                                                        <li><a href="<?php echo e($member->linkedin); ?>"><i
                                                                    class="flaticon-linkedin"></i></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team-content text-center">
                                        <h4 class="title"><?php echo e(convertUtf8($member->name)); ?></h4>
                                        <span><?php echo e(convertUtf8($member->rank)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <h3><?php echo e($keywords['NO MEMBERS FOUND!'] ?? __('NO MEMBERS FOUND!')); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($userBs->testimonial_section == 1): ?>
        <section class="client-area bg_cover pt-105 pb-95 lazy"
            data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TESTIMONIAL_IMAGES, $userBe->testimonial_bg_img, $userBs)); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="client-title text-center">
                            <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->testimonial_title)); ?></h3>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <?php if($testimonials->count() > 0): ?>
                            <div class="client-items client-active">

                                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-client">
                                        <div class="text">
                                            <p><?php echo e(convertUtf8($testimonial?->comment)); ?></p>
                                        </div>
                                        <div class="client-info d-block d-sm-flex justify-content-between">
                                            <div class="item-1">
                                                <?php if($testimonial->image): ?>
                                                    <img class="lazy wow fadeIn"
                                                        data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_TESTIMONIAL_IMAGES, $testimonial->image, $userBs)); ?>"
                                                        alt="clients">
                                                <?php endif; ?>
                                                <span><?php echo e(convertUtf8($testimonial->name)); ?></span>
                                                <p><?php echo e(convertUtf8($testimonial->rank)); ?></p>
                                            </div>
                                            <div class="item-2 text-sm-right text-left">
                                                <ul>
                                                    <?php
                                                        $i = 0;
                                                        for ($i == 1; $i < $testimonial->rating; $i++) {
                                                            echo '<li><i class="flaticon-star"></i></li>';
                                                        }
                                                    ?>
                                                </ul>
                                                <span>(<?php echo e($testimonial->rating); ?> <?php echo e(__('Stars')); ?>)</span>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        <?php else: ?>
                            <h3 class="text-center"><?php echo e($keywords['NO CLIEND FOUND!'] ?? __('NO CLIEND FOUND!')); ?></h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($userBs->news_section == 1): ?>
        <section class="blog-area pb-95 pt-105" style="<?php echo e($blogs->count() == 0 ? 'background:#f1f1f1' : ''); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="section-title text-center">
                            <span><?php echo e(convertUtf8($sectionHeading?->blog_title)); ?> <img
                                    src="<?php echo e(asset('assets/front/img/title-icon.png')); ?>" alt=""></span>
                            <h3 class="title"><?php echo e(convertUtf8($sectionHeading?->blog_subtitle)); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php if($blogs->count() > 0): ?>
                        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4">
                                <div class="single-blog mt-30">
                                    <div class="blog-thumb">
                                        <img class="lazy wow fadeIn"
                                            data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_BLOG_IMAGE, $blog->image, $userBs)); ?>"
                                            alt="" data-wow-delay=".5s" data-wow-duration="1s" >
                                    </div>
                                    <div class="blog-content">
                                        <a
                                            href="<?php echo e(route('user.front.blog.details', [getParam(), $blog->slug, $blog->id])); ?>">
                                            <h3 class="title">
                                              <?php echo e(strlen(convertUtf8($blog->title)) > 27 ? mb_substr(convertUtf8($blog->title), 0, 27, 'UTF-8') . '...' : convertUtf8($blog->title)); ?>

                                            </h3>
                                        </a>
                                        <p>
                                            <?php echo e(convertUtf8(strlen(strip_tags($blog->content)) > 100) ? convertUtf8(substr(strip_tags($blog->content), 0, 100)) . '...' : convertUtf8(strip_tags($blog->content))); ?>

                                        </p>

                                        <div
                                            class="blog-comments d-block d-sm-flex justify-content-between align-items-center">
                                            <a
                                                href="<?php echo e(route('user.front.blog.details', [getParam(), $blog->slug, $blog->id])); ?>"><?php echo e($keywords['Read More'] ?? __('Read More')); ?></a>
                                            <ul>
                                                <?php
                                            app()->setLocale($userCurrentLang->code);
                                        ?>
                                                <li><i class="far fa-calendar-alt"></i>
                                                    <?php echo e(Carbon::parse($blog->created_at)->diffForHumans()); ?>

                                                    <span>|</span> <?php echo e($keywords['Admin'] ?? __('Admin')); ?>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                     <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                          <h3><?php echo e($keywords['NO BLOG POST FOUND!'] ?? __('NO BLOG POST FOUND!')); ?></h3>
                        </div>
                    </div>
                </div>


                </div>
    <?php endif; ?>
    </div>

    </section>
    <?php endif; ?>

    <?php if($userBs->is_quote == 1): ?>
        <?php if($userBs->table_section == 1): ?>
            <section class="reservation-area bg_cover pt-4">
                <div id="map">
                    
                    <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?php echo e($userBs->latitude); ?>,%20<?php echo e($userBs->longitude); ?>+(My%20Business%20Name)&amp;t=&amp;z=<?php echo e($userBs->map_zoom); ?>&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($__env->exists('user-front.partials.variation-modal')) echo $__env->make('user-front.partials.variation-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user-front/index.blade.php ENDPATH**/ ?>