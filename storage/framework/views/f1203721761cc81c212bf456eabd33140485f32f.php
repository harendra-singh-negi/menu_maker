<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('FAQs')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->faqs_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->faqs_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('FAQ')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('FAQ')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
    <div id="faq" class="faq-area pt-120 pb-90">
        <div class="container">
            <div class="accordion" id="faqAccordion">
                <div class="row">
                    <div class="col-lg-6 has-time-line" data-aos="fade-right">
                        <div class="row">
                            <?php for($i=0; $i < ceil(count($faqs)/2); $i++): ?>
                                <div class="col-12">
                                    <div class="accordion-item">
                                        <h6 class="accordion-header" id="heading<?php echo e($faqs[$i]->id); ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?php echo e($faqs[$i]->id); ?>" aria-expanded="true"
                                                    aria-controls="collapse<?php echo e($faqs[$i]->id); ?>">
                                                <?php echo e($faqs[$i]->question); ?>

                                            </button>
                                        </h6>
                                        <div id="collapse<?php echo e($faqs[$i]->id); ?>"
                                             class="accordion-collapse collapse <?php echo e($i == 0 ? 'show':''); ?>"
                                             aria-labelledby="heading<?php echo e($faqs[$i]->id); ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p><?php echo e($faqs[$i]->answer); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="row">
                            <?php for($i=ceil(count($faqs)/2); $i < count($faqs); $i++): ?>
                                <div class="col-12">
                                    <div class="accordion-item">
                                        <h6 class="accordion-header" id="heading<?php echo e($faqs[$i]->id); ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?php echo e($faqs[$i]->id); ?>" aria-expanded="true"
                                                    aria-controls="collapse<?php echo e($faqs[$i]->id); ?>">
                                                <?php echo e($faqs[$i]->question); ?>

                                            </button>
                                        </h6>
                                        <div id="collapse<?php echo e($faqs[$i]->id); ?>"
                                             class="accordion-collapse collapse <?php echo e($i == 0 ? 'show':''); ?>"
                                             aria-labelledby="heading<?php echo e($faqs[$i]->id); ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <p><?php echo e($faqs[$i]->answer); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/front/faq.blade.php ENDPATH**/ ?>