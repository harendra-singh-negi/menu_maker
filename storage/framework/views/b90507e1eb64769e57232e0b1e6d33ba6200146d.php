<?php $__env->startSection('meta-description', !empty($seo) ? $seo->contact_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->contact_meta_keywords : ''); ?>

<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Contact')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="contact-area pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row justify-content-center">
                        <?php
                            $phones = explode(',', $be->contact_numbers);
                            $mails = explode(',', $be->contact_mails);
                            $addresses = explode(PHP_EOL, $be->contact_addresses);
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card mb-30 blue" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon">
                                    <i class="fal fa-phone-plus"></i>
                                </div>
                                <div class="card-text">
                                    <?php $__currentLoopData = $phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><a href="tel:<?php echo e($phone); ?>"><?php echo e($phone); ?></a></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card mb-30 green" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="card-text">
                                    <?php $__currentLoopData = $mails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><a href="mailTo:<?php echo e($mail); ?>"><?php echo e($mail); ?></a></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card mb-50 orange" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="card-text">
                                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><?php echo e($address); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8 mb-30" data-aos="fade-up" data-aos-delay="100">
                            <form id="contactForm" action="<?php echo e(route('front.admin.contact.message')); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input type="text" name="name" class="form-control" id="name"
                                                required data-error="Enter your name"
                                                placeholder="<?php echo e(__('Full Name')); ?> *" />
                                            <?php if($errors->has('name')): ?>
                                                <div class="help-block with-errors text-danger"><?php echo e($errors->first('name')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-30">
                                            <input type="email" name="email" class="form-control" id="email"
                                                required data-error="Enter your email"
                                                placeholder="<?php echo e(__('Email Address')); ?>*" />
                                            <?php if($errors->has('email')): ?>
                                                <div class="help-block with-errors text-danger"><?php echo e($errors->first('email')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-30">
                                            <input type="text" name="subject" class="form-control" id="subject"
                                                required data-error="Enter your subject"
                                                placeholder="<?php echo e(__('Subject')); ?>*" />
                                            <?php if($errors->has('subject')): ?>
                                                <div class="help-block with-errors text-danger"><?php echo e($errors->first('subject')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-30">
                                            <textarea name="message" id="message" class="form-control" cols="30" rows="8" required
                                                data-error="Please enter your message" placeholder="<?php echo e(__('Message')); ?>... *"></textarea>
                                            <?php if($errors->has('message')): ?>
                                                <div class="help-block with-errors text-danger"><?php echo e($errors->first('message')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-30">
                                        <?php if($bs->is_recaptcha == 1): ?>
                                            <div class="d-block mb-4">
                                                <?php echo NoCaptcha::renderJs(); ?>

                                                <?php echo NoCaptcha::display(); ?>

                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                    <?php
                                                        $errmsg = $errors->first('g-recaptcha-response');
                                                    ?>
                                                    <p class="text-danger mb-0 mt-2"><?php echo e(__("$errmsg")); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn primary-btn primary-btn-5"
                                            title="Send message"><?php echo e(__('Send Message')); ?></button>
                                        <div id="msgSubmit"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/front/contact.blade.php ENDPATH**/ ?>