<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<div class="banner-slide">
    <?php if($sliders->count() > 0): ?>
    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="banner-area bg_cover d-flex align-items-center lazy"
             data-bg="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_SLIDER_BACKGROUND_IMAGES,$slider->bg_image,$userBs)); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-7">
                        <div class="banner-content">
                            <h1 data-animation="fadeInUp" data-delay="1s" class="title"
                                style="color: #<?php echo e($slider->title_color); ?>; font-size: <?php echo e($slider->title_font_size); ?>px;"><?php echo e(convertUtf8($slider->title)); ?></h1>
                            <p data-animation="fadeInUp" data-delay="1.3s"
                               style="color: #<?php echo e($slider->text_color); ?>; font-size: <?php echo e($slider->text_font_size); ?>px;"><?php echo e(convertUtf8($slider->text)); ?></p>
                            <ul data-animation="fadeInUp" data-delay="1.6s">
                                <?php if($slider->button_text && $slider->button_url): ?>
                                    <li>
                                        <a style="color:#<?php echo e($slider->button_color); ?>;border: 2px solid #<?php echo e($slider->button_color); ?>;font-size: <?php echo e($slider->button_text_font_size); ?>px;"
                                           class="main-btn"
                                           href="<?php echo e($slider->button_url); ?>">
                                            <?php echo e(convertUtf8($slider->button_text)); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($slider->button_text1 && $slider->button_url1): ?>
                                    <li>
                                        <a class="main-btn main-btn-2" href="<?php echo e($slider->button_url1); ?>"
                                           style="font-size: <?php echo e($slider->button_text1_font_size); ?>px;"><?php echo e(convertUtf8($slider->button_text1)); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($slider->image): ?>
                <div class="banner-thumb d-none d-md-block">
                    <img class="lazy"
                         data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_SLIDER_IMAGES,$slider->image,$userBs)); ?>"
                         alt="banner">
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <div class="banner-area bg_cover d-flex align-items-center" style="background-image:url(<?php echo e(asset('assets/restaurant/images/hero-banner-bg.jpg')); ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-7">
                        <div class="banner-content">
                            <h1 data-animation="fadeInUp" data-delay="1s" class="title"
                                style="color: #fff; font-size: 59px;">Mexican Chicken Cheese Toaster Pizza</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s"
                               style="color: #fff; font-size: 19px;">Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus sus-cipit massa dapibu.</p>
                            <ul data-animation="fadeInUp" data-delay="1.6s">
                                
                                    <li>
                                        <a style="color:#fff;border: 2px solid #fff;font-size: 15px;"
                                           class="main-btn"
                                           href="#">
                                            View Details
                                        </a>
                                    </li>
                              
                               
                                    <li>
                                        <a class="main-btn main-btn-2" href="#"
                                           style="font-size: 15px;">Book A Table
                                        </a>
                                    </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
         
                <div class="banner-thumb  d-md-block">
                    <img class="lazy"
                         data-src="<?php echo e(asset('assets/restaurant/images/demoBurger.png')); ?>"
                         alt="banner">
                </div>
          
        </div>
    
    
    <?php endif; ?>
</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user-front/hero/slider.blade.php ENDPATH**/ ?>