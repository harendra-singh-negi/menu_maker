<li
    class="nav-item
<?php if(request()->path() == 'user/features'): ?> active
<?php elseif(request()->path() == 'user/introsection'): ?> active
<?php elseif(request()->path() == 'user/special/section'): ?> active
<?php elseif(request()->is('user/menu/special/update')): ?> active
<?php elseif(request()->path() == 'user/herosection/imgtext'): ?> active
<?php elseif(request()->path() == 'user/herosection/video'): ?> active
<?php elseif(request()->path() == 'user/herosection/sliders'): ?> active
<?php elseif(request()->is('user/herosection/slider/*/edit')): ?> active
<?php elseif(request()->path() == 'user/members'): ?> active
<?php elseif(request()->is('user/member/*/edit')): ?> active
<?php elseif(request()->is('user/feature/*/edit')): ?> active
<?php elseif(request()->path() == 'user/testimonials'): ?> active
<?php elseif(request()->is('user/testimonial/*/edit')): ?> active
<?php elseif(request()->path() == 'user/member/create'): ?> active
<?php elseif(request()->path() == 'user/sections'): ?> active

<?php elseif(request()->path() == 'user/page/create'): ?> active
<?php elseif(request()->path() == 'user/pages'): ?> active
<?php elseif(request()->path() == 'user/section/heading'): ?> active
<?php elseif(request()->is('user/page/*/edit')): ?> active

<?php elseif(request()->path() == 'user/footers'): ?> active
<?php elseif(request()->path() == 'user/ulinks'): ?> active
<?php elseif(request()->path() == 'user/bottom/links'): ?> active

<?php elseif(request()->path() == 'user/jcategorys'): ?> active
<?php elseif(request()->path() == 'user/job/create'): ?> active
<?php elseif(request()->is('user/jcategory/*/edit')): ?> active
<?php elseif(request()->path() == 'user/jobs'): ?> active
<?php elseif(request()->is('user/job/*/edit')): ?> active

<?php elseif(request()->path() == 'user/gallery'): ?> active
<?php elseif(request()->path() == 'user/gallery/create'): ?> active
<?php elseif(request()->is('user/gallery/*/edit')): ?> active

<?php elseif(request()->path() == 'user/faqs'): ?> active

<?php elseif(request()->path() == 'user/contact'): ?> active <?php endif; ?>">
    <a data-toggle="collapse" href="#webContents">
        <i class="la flaticon-imac"></i>
        <p>Website Pages</p>
        <span class="caret"></span>
    </a>
    <div class="collapse
    <?php if(request()->path() == 'user/features'): ?> show
    <?php elseif(request()->path() == 'user/introsection'): ?> show
    <?php elseif(request()->path() == 'user/section/heading'): ?> show
    <?php elseif(request()->path() == 'user/special/section'): ?> show
    <?php elseif(request()->is('user/menu/special/update')): ?> show
    <?php elseif(request()->path() == 'user/herosection/imgtext'): ?> show
    <?php elseif(request()->path() == 'user/herosection/video'): ?> show
    <?php elseif(request()->path() == 'user/herosection/sliders'): ?> show
    <?php elseif(request()->is('user/herosection/slider/*/edit')): ?> show
    <?php elseif(request()->path() == 'user/members'): ?> show
    <?php elseif(request()->is('user/member/*/edit')): ?> show
    <?php elseif(request()->is('user/feature/*/edit')): ?> show
    <?php elseif(request()->path() == 'user/testimonials'): ?> show
    <?php elseif(request()->is('user/testimonial/*/edit')): ?> show
    <?php elseif(request()->path() == 'user/member/create'): ?> show
    <?php elseif(request()->path() == 'user/sections'): ?> show

    <?php elseif(request()->path() == 'user/page/create'): ?> show
    <?php elseif(request()->path() == 'user/pages'): ?> show
    <?php elseif(request()->is('user/page/*/edit')): ?> show

    <?php elseif(request()->path() == 'user/footers'): ?> show
    <?php elseif(request()->path() == 'user/ulinks'): ?> show
    <?php elseif(request()->path() == 'user/bottom/links'): ?> show

    <?php elseif(request()->path() == 'user/jcategorys'): ?> show
    <?php elseif(request()->path() == 'user/job/create'): ?> show
    <?php elseif(request()->is('user/jcategory/*/edit')): ?> show
    <?php elseif(request()->path() == 'user/jobs'): ?> show
    <?php elseif(request()->is('user/job/*/edit')): ?> show

    <?php elseif(request()->path() == 'user/gallery'): ?> show
    <?php elseif(request()->path() == 'user/gallery/create'): ?> show
    <?php elseif(request()->is('user/gallery/*/edit')): ?> show

    <?php elseif(request()->path() == 'user/faqs'): ?> show


    <?php elseif(request()->path() == 'user/contact'): ?> show <?php endif; ?>"
        id="webContents">
        <ul class="nav nav-collapse">


            <li
                class="
            <?php if(request()->path() == 'user/features'): ?> selected
            <?php elseif(request()->path() == 'user/introsection'): ?> selected
            <?php elseif(request()->path() == 'user/special/section'): ?> selected
            <?php elseif(request()->is('user/menu/special/update')): ?> selected
            <?php elseif(request()->path() == 'user/herosection/imgtext'): ?> selected
            <?php elseif(request()->path() == 'user/herosection/video'): ?> selected
            <?php elseif(request()->path() == 'user/herosection/sliders'): ?> selected
            <?php elseif(request()->is('user/herosection/slider/*/edit')): ?> selected
            <?php elseif(request()->path() == 'user/members'): ?> selected
            <?php elseif(request()->is('user/member/*/edit')): ?> selected
            <?php elseif(request()->is('user/feature/*/edit')): ?> selected
            <?php elseif(request()->path() == 'user/testimonials'): ?> selected
            <?php elseif(request()->is('user/testimonial/*/edit')): ?> selected
            <?php elseif(request()->path() == 'user/member/create'): ?> selected
            <?php elseif(request()->path() == 'user/sections'): ?> selected
            <?php elseif(request()->path() == 'user/section/heading'): ?> selected <?php endif; ?>">
                <a data-toggle="collapse" href="#home">
                    <span class="sub-item">Home Page Sections</span>
                    <span class="caret"></span>
                </a>
                <div class="collapse
                <?php if(request()->path() == 'user/features'): ?> show
                <?php elseif(request()->path() == 'user/introsection'): ?> show
                <?php elseif(request()->path() == 'user/special/section'): ?> show
                <?php elseif(request()->is('user/menu/special/update')): ?> show
                <?php elseif(request()->path() == 'user/herosection/imgtext'): ?> show
                <?php elseif(request()->path() == 'user/herosection/video'): ?> show
                <?php elseif(request()->path() == 'user/herosection/sliders'): ?> show
                <?php elseif(request()->is('user/herosection/slider/*/edit')): ?> show
                <?php elseif(request()->path() == 'user/members'): ?> show
                <?php elseif(request()->is('user/member/*/edit')): ?> show
                <?php elseif(request()->is('user/feature/*/edit')): ?> show
                <?php elseif(request()->path() == 'user/testimonials'): ?> show
                <?php elseif(request()->is('user/testimonial/*/edit')): ?> show
                <?php elseif(request()->path() == 'user/member/create'): ?> show
                <?php elseif(request()->path() == 'user/sections'): ?> show
                <?php elseif(request()->path() == 'user/section/heading'): ?> show <?php endif; ?>"
                    id="home">

                    <ul class="nav nav-collapse subnav">
                        <li
                            class="
                            <?php if(request()->path() == 'user/herosection/sliders'): ?> active
                            <?php elseif(request()->is('user/herosection/slider/*/edit')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.slider.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Hero Section</span>
                            </a>
                        </li>
                        <li
                            class="
                    <?php if(request()->path() == 'user/features'): ?> active
                    <?php elseif(request()->is('user/feature/*/edit')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.feature.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Features</span>
                            </a>
                        </li>

                        <li class="<?php if(request()->path() == 'user/introsection'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.introsection.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Intro Section</span>
                            </a>
                        </li>

                        <li
                            class="
                    <?php if(request()->path() == 'user/special/section'): ?> active
                    <?php elseif(request()->is('user/menu/special/update')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.special.section.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Special Section</span>
                            </a>
                        </li>

                        <li
                            class="
                    <?php if(request()->path() == 'user/testimonials'): ?> active
                    <?php elseif(request()->is('user/testimonial/*/edit')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.testimonial.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Testimonials</span>
                            </a>
                        </li>
                        <li
                            class="
                    <?php if(request()->path() == 'user/members'): ?> active
                    <?php elseif(request()->is('user/member/*/edit')): ?> active
                    <?php elseif(request()->path() == 'user/member/create'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.member.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Team Section</span>
                            </a>
                        </li>
                        <li class="<?php if(request()->path() == 'user/section/heading'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.section.heading') . '?language=' . $default->code); ?>">
                                <span class="sub-item"><?php echo e(__('Section Headings')); ?></span>
                            </a>
                        </li>
                        <li class="
                    <?php if(request()->path() == 'user/sections'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.sections.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Section Customization</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>



            <li
                class="
            <?php if(request()->path() == 'user/footers'): ?> selected
            <?php elseif(request()->path() == 'user/ulinks'): ?> selected
            <?php elseif(request()->path() == 'user/bottom/links'): ?> selected <?php endif; ?>">
                <a data-toggle="collapse" href="#footer">
                    <span class="sub-item">Footer</span>
                    <span class="caret"></span>
                </a>
                <div class="collapse
                <?php if(request()->path() == 'user/footers'): ?> show
                <?php elseif(request()->path() == 'user/ulinks'): ?> show
                <?php elseif(request()->path() == 'user/bottom/links'): ?> show <?php endif; ?>"
                    id="footer">
                    <ul class="nav nav-collapse subnav">
                        <li class="<?php if(request()->path() == 'user/footers'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.footer.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Image & Text</span>
                            </a>
                        </li>
                        <li class="<?php if(request()->path() == 'user/ulinks'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.ulink.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Useful Links</span>
                            </a>
                        </li>
                        <li class="<?php if(request()->path() == 'user/bottom/links'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.blink.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Bottom Links</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li
                class="<?php if(request()->path() == 'user/gallery'): ?> selected
                <?php elseif(request()->path() == 'user/gallery/create'): ?> selected
                <?php elseif(request()->is('user/gallery/*/edit')): ?> selected <?php endif; ?>">
                <a href="<?php echo e(route('user.gallery.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item">Gallery</span>
                </a>
            </li>

            <li class="<?php if(request()->path() == 'user/faqs'): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('user.faq.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item">FAQs</span>
                </a>
            </li>


            <li
                class="
            <?php if(request()->path() == 'user/jcategorys'): ?> selected
            <?php elseif(request()->path() == 'user/job/create'): ?> selected
            <?php elseif(request()->is('user/jcategory/*/edit')): ?> selected
            <?php elseif(request()->path() == 'user/jobs'): ?> selected
            <?php elseif(request()->is('user/job/*/edit')): ?> selected <?php endif; ?>">
                <a data-toggle="collapse" href="#career">
                    <span class="sub-item">Career</span>
                    <span class="caret"></span>
                </a>
                <div class="collapse
                <?php if(request()->path() == 'user/jcategorys'): ?> show
                <?php elseif(request()->path() == 'user/job/create'): ?> show
                <?php elseif(request()->is('user/jcategory/*/edit')): ?> show
                <?php elseif(request()->path() == 'user/jobs'): ?> show
                <?php elseif(request()->is('user/job/*/edit')): ?> show <?php endif; ?>"
                    id="career">
                    <ul class="nav nav-collapse subnav">
                        <li
                            class="
                            <?php if(request()->path() == 'user/jcategorys'): ?> active
                            <?php elseif(request()->is('user/jcategory/*/edit')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.jcategory.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Category</span>
                            </a>
                        </li>
                        <li class="
                        <?php if(request()->is('user/job/create')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.job.create')); ?>">
                                <span class="sub-item">Post Job</span>
                            </a>
                        </li>
                        <li
                            class="
                        <?php if(request()->path() == 'user/jobs'): ?> active
                        <?php elseif(request()->is('user/job/*/edit')): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route('user.job.index') . '?language=' . $default->code); ?>">
                                <span class="sub-item">Job Management</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="
            <?php if(request()->path() == 'user/contact'): ?> selected <?php endif; ?>">
                <a href="<?php echo e(route('user.contact.index') . '?language=' . $default->code); ?>">
                    <span class="sub-item">Contact Page</span>
                </a>
            </li>
        </ul>
    </div>

</li>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/website-pages.blade.php ENDPATH**/ ?>