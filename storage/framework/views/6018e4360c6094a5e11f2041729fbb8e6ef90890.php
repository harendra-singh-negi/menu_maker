<?php $__env->startSection('meta-description', !empty($seo) ? $seo->about_us_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->about_us_meta_keywords : ''); ?>

<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('About Us')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('About Us')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('About Us')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <div class=" pt-120 pb-90">
    <section class="choose-area pb-90">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="choose-content mb-30" data-aos="fade-right">
                        <span class="subtitle"><?php echo e($bs->intro_title); ?></span>
                        <h2 class="title"><?php echo e($bs->intro_subtitle); ?></h2>
                        <p class="text"><?php echo nl2br($bs->intro_text); ?></p>
                        <div class="d-flex align-items-center">
                            <?php if($bs->intro_section_button_url): ?>
                                <a href="<?php echo e($bs->intro_section_button_url); ?>" class="btn primary-btn">
                                    <?php echo e($bs->intro_section_button_text); ?>

                                </a>
                            <?php endif; ?>
                            <?php if($bs->intro_section_video_url): ?>
                                <a href="<?php echo e($bs->intro_section_video_url); ?>" class="btn video-btn youtube-popup"><i
                                        class="fas fa-play"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row justify-content-center">
                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-4 col-sm-6" data-aos="fade-up">
                                <div class="card mb-30">
                                    <div class="card-icon">
                                        <img src="<?php echo e(asset('assets/front/img/features/' . $feature->image)); ?>"
                                            alt="Icon">
                                    </div>
                                    <div class="card-content">
                                        <a href="javascript:void(0);">
                                            <h5 class="card-title"><?php echo e($feature->title); ?></h5>
                                        </a>
                                        <p class="card-text"><?php echo e($feature->text); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape">
            <img class="shape-1" src="<?php echo e(asset('assets/restaurant/images/shape/shape-5.png')); ?>" alt="Shape">
            <img class="shape-2" src="<?php echo e(asset('assets/restaurant/images/shape/shape-2.png')); ?>" alt="Shape">
            <img class="shape-3" src="<?php echo e(asset('assets/restaurant/images/shape/shape-7.png')); ?>" alt="Shape">
        </div>
    </section>

     <section class="store-area pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title title-inline" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="title mb-0"><?php echo e($bs->work_process_title); ?></h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center">
                        <?php if($processes->count() > 0): ?>
                            <?php $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6 col-lg-6 col-xl-3" data-aos="fade-up">
                                    <div class="card mb-30">
                                        <div class="card-icon">
                                            <i class="<?php echo e($process->icon); ?>"></i>
                                        </div>
                                        <div class="card-content">
                                           
                                                <h3 class="card-title"><?php echo e($process->title); ?></h3>
                                           
                                            <p class="card-text"><?php echo e($process->text); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <h3 class="text-center py-2" data-aos="fade-up" data-aos-delay="100">
                                <?php echo e(__('No Data Found!')); ?>

                            </h3>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="shape">
            <img class="shape-1" src="<?php echo e(asset('assets/restaurant/images/shape/shape-2.png')); ?>" alt="Shape">
            <img class="shape-2" src="<?php echo e(asset('assets/restaurant/images/shape/shape-3.png')); ?>" alt="Shape">
            <img class="shape-3" src="<?php echo e(asset('assets/restaurant/images/shape/shape-9.png')); ?>" alt="Shape">
        </div>
    </section>

    <section class="testimonial-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title ms-0" data-aos="fade-right">
                        <h2 class="title"><?php echo e($bs->testimonial_title); ?></h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row align-items-center gx-xl-5">
                        <div class="col-lg-6">
                            <div class="image image-left mb-30" data-aos="fade-right">
                                <img src="<?php echo e(asset('assets/front/img/testimonials/' . $be->testimonial_img)); ?>"
                                    alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="swiper testimonial-slider" data-aos="fade-left">
                                <div class="swiper-wrapper">
                                    <?php for($i = 0; $i <= count($testimonials); $i = $i + 2): ?>
                                        <?php if($i < count($testimonials) - 1): ?>
                                            <div class="swiper-slide">
                                                <div class="slider-item">
                                                    <div class="quote">
                                                        <span class="icon"><i class="fas fa-quote-right"></i></span>
                                                        <p class="text">
                                                            <?php echo e($testimonials[$i]->comment); ?>

                                                        </p>
                                                    </div>
                                                    <div class="client">
                                                        <div class="image">
                                                            <div class="lazy-container aspect-ratio-1-1">
                                                                <img class="lazyload lazy-image"
                                                                    data-src="<?php echo e($testimonials[$i]->image ? asset('assets/front/img/testimonials/' . $testimonials[$i]->image) : asset('assets/restaurant/images/client/client-1.jpg')); ?>"
                                                                    alt="Person Image">
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <h6 class="name"><?php echo e($testimonials[$i]->name); ?></h6>
                                                            <span class="designation"><?php echo e($testimonials[$i]->rank); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-item">
                                                    <div class="quote">
                                                        <span class="icon"><i class="fas fa-quote-right"></i></span>
                                                        <p class="text">
                                                            <?php echo e($testimonials[$i + 1]->comment); ?>

                                                        </p>
                                                    </div>
                                                    <div class="client">
                                                        <div class="image">
                                                            <div class="lazy-container aspect-ratio-1-1">
                                                                <img class="lazyload lazy-image"
                                                                    data-src="<?php echo e($testimonials[$i + 1]->image ? asset('assets/front/img/testimonials/' . $testimonials[$i + 1]->image) : asset('assets/restaurant/images/client/client-1.jpg')); ?>"
                                                                    alt="Person Image">
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <h6 class="name"><?php echo e($testimonials[$i + 1]->name); ?></h6>
                                                            <span
                                                                class="designation"><?php echo e($testimonials[$i + 1]->rank); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="swiper-pagination" id="testimonial-slider-pagination" data-min data-max>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape">
            <img class="shape-1" src="<?php echo e(asset('assets/restaurant/images/shape/shape-2.png')); ?>" alt="Shape">
            <img class="shape-2" src="<?php echo e(asset('assets/restaurant/images/shape/shape-9.png')); ?>" alt="Shape">
            <img class="shape-3" src="<?php echo e(asset('assets/restaurant/images/shape/shape-10.png')); ?>" alt="Shape">
            <img class="shape-4" src="<?php echo e(asset('assets/restaurant/images/shape/shape-4.png')); ?>" alt="Shape">
        </div>
    </section>

</div> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/front/about_us.blade.php ENDPATH**/ ?>