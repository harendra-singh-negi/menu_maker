<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>



<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">Sliders</h4>
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
                <a href="#">Website Pages</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Home Page</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Hero Section</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Sliders</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card-title">Images</div>
                        </div>
                        <div class="col-lg-2">
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
                    </div>
                </div>
                <form class="" action="<?php echo e(route('user.slider.image.update', $lang_id)); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <label for="image"><strong> Shape Image</strong></label>
                                    </div>
                                    <div class="showImage mb-3">
                                        <?php if(!empty($abe->slider_shape_img)): ?>
                                            <a class="remove-image" data-type="shape"><i
                                                    class="far fa-times-circle"></i></a>
                                        <?php endif; ?>
                                        <?php if($abe->slider_shape_img): ?>
                                            <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $abe->slider_shape_img, $userBs)); ?>"
                                                alt="..." class="img-thumbnail w-100" width="200">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                                class="img-thumbnail" width="150">
                                        <?php endif; ?>
                                    </div>
                                    <input type="file" name="slider_shape_img" class="form-control image">
                                    <p id="errslider_shape_img" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <label for="image"><strong> Bottom Image</strong></label>
                                    </div>
                                    <div class="showImage mb-3">
                                        <?php if(!empty($abe->slider_bottom_img)): ?>
                                            <a class="remove-image" data-type="bottom"><i
                                                    class="far fa-times-circle"></i></a>
                                        <?php endif; ?>
                                        <?php if(!empty($abe->slider_bottom_img)): ?>
                                            <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $abe->slider_bottom_img, $userBs)); ?>"
                                                alt="..." class="img-thumbnail w-100" width="200">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                                class="img-thumbnail" width="150">
                                        <?php endif; ?>

                                    </div>
                                    <input type="file" name="slider_bottom_img" class="form-control image">
                                    <p id="errslider_bottom_img" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form">
                            <div class="form-group from-show-notify row">
                                <div class="col-12 text-center">
                                    <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block">Sliders</div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-primary float-lg-right float-left" data-toggle="modal"
                                data-target="#createModal"><i class="fas fa-plus"></i> Add Slider</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(count($sliders) == 0): ?>
                                <h3 class="text-center">NO SLIDER FOUND</h3>
                            <?php else: ?>
                                <div class="row">
                                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img class="w-100"
                                                        src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_SLIDER_IMAGES, $slider->image, $userBs)); ?>"
                                                        alt="">
                                                </div>
                                                <div class="card-footer text-center">
                                                    <a class="btn btn-secondary btn-sm mr-2"
                                                        href="<?php echo e(route('user.slider.edit', $slider->id) . '?language=' . request()->input('language')); ?>">
                                                        <span class="btn-label">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                        Edit
                                                    </a>
                                                    <form class="deleteform d-inline-block"
                                                        action="<?php echo e(route('user.slider.delete')); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="slider_id"
                                                            value="<?php echo e($slider->id); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                            <span class="btn-label">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-form" id="ajaxForm" action="<?php echo e(route('user.slider.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-12 mb-2">
                                        <label for="image"><strong>Side Image</strong></label>
                                    </div>
                                    <div class="col-md-12 showImage mb-3">
                                        <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                            class="img-thumbnail" width="200">
                                    </div>
                                    <input type="file" name="main_image" class="form-control image">
                                    <p id="errmain_image" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-12 mb-2">
                                        <label for="image"><strong> Background Image</strong></label>
                                    </div>
                                    <div class="col-md-12 bg_image mb-3">
                                        <img src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" alt="..."
                                            class="img-thumbnail" width="200">
                                    </div>
                                    <input type="file" name="bg_image" id="bg_image" class="form-control image">
                                    <p id="errbg_image" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Language **</label>
                                    <select name="user_language_id" class="form-control">
                                        <option value="" selected disabled>Select a language</option>
                                        <?php $__currentLoopData = $userLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <p id="erruser_language_id" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Title **</label>
                                    <input type="text" class="form-control" name="title" value=""
                                        placeholder="Enter Title">
                                    <p id="errtitle" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Title Font Size **</label>
                                    <input type="number" class="form-control ltr" name="title_font_size" value=""
                                        placeholder="Enter Title Font Size">
                                    <p id="errtitle_font_size" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title Color Code **</label>
                                    <input class="jscolor form-control ltr" name="title_color" value="">
                                    <p id="errtitle_color" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Text **</label>
                                    <input type="text" class="form-control" name="text" value=""
                                        placeholder="Enter Text">
                                    <p id="errtext" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Text Font Size **</label>
                                    <input type="number" class="form-control ltr" name="text_font_size" value=""
                                        placeholder="Enter Text Font Size">
                                    <p id="errtext_font_size" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Text Color Code **</label>
                                    <input class="jscolor form-control ltr" name="text_color" value="">
                                    <p id="errtext_color" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Button 1 Text</label>
                                    <input type="text" class="form-control" name="button_text" value=""
                                        placeholder="Enter Button Text">
                                    <p id="errbutton_text" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Button 1 Text Font Size **</label>
                                    <input type="text" class="form-control ltr" name="button_text_font_size"
                                        value="" placeholder="Enter Button Text">
                                    <p id="errbutton_text_font_size" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Button 1 URL</label>
                                    <input type="text" class="form-control ltr" name="button_url" value=""
                                        placeholder="Enter Button URL">
                                    <p id="errbutton_url" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Button 1 Color Code **</label>
                                    <input class="jscolor form-control ltr" name="button_color" value="">
                                    <p id="errbutton_color" class="mb-0 text-danger em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Button 2 Text</label>
                                    <input type="text" class="form-control" name="button_text1"
                                        placeholder="Enter Button Text">
                                    <p id="errbutton_text1" class="text-danger mb-0 em"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Button 2 URL</label>
                                    <input type="text" class="form-control ltr" name="button_url1"
                                        placeholder="Enter Button URL">
                                    <p id="errbutton_url1" class="text-danger mb-0 em"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Button 2 Text Font Size **</label>
                                    <input type="text" class="form-control ltr" name="button_text1_font_size"
                                        placeholder="Enter Button Text">
                                    <p id="errbutton_text1_font_size" class="text-danger mb-0 em"></p>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Serial Number **</label>
                            <input type="number" class="form-control ltr" name="serial_number" value=""
                                placeholder="Enter Serial Number">
                            <p id="errserial_number" class="mb-0 text-danger em"></p>
                            <p class="text-warning"><small>The higher the serial number is, the later the slider will be
                                    shown.</small></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let routeUrl = "<?php echo e(route('user.slider.image.remove')); ?>";
    let currentUrl = "<?php echo e(url()->current()); ?>";
    let langCode = "<?php echo e($abe->language->code); ?>";
</script>
<script src="<?php echo e(asset('assets/tenant/js/blade.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/home/hero/slider/index.blade.php ENDPATH**/ ?>