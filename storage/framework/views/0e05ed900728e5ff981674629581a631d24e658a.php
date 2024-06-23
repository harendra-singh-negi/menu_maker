<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <title><?php echo e($bs->website_title); ?> - <?php echo e(__('User Dashboard')); ?></title>
    <link rel="icon" href="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_FAVICON, $userBs->favicon, $userBs)); ?>" >

    <?php if ($__env->exists('user.partials.styles')) echo $__env->make('user.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $user = getRootUser();
        $setLang = App\Models\User\Language::query()
            ->where('code', request()->input('language'))
            ->where('user_id', $user->id)
            ->first();
    ?>
    <?php if(!empty($setLang) && $setLang->rtl == 1): ?>
        <style>
            #editModal form input,
            #editModal form textarea,
            #editModal form select {
                direction: rtl;
            }

            #editModal form .note-editor.note-frame .note-editing-area .note-editable {
                direction: rtl;
                text-align: right;
            }
        </style>
    <?php endif; ?>
    

</head>

<body <?php if(request()->cookie('user-theme') == 'dark'): ?> data-background-color="dark" <?php endif; ?>>
    <div class="wrapper <?php echo $__env->yieldContent('sidebar'); ?>">

  
        <?php if ($__env->exists('user.partials.top-navbar')) echo $__env->make('user.partials.top-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if ($__env->exists('user.partials.side-navbar')) echo $__env->make('user.partials.side-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <?php if ($__env->exists('user.partials.footer')) echo $__env->make('user.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </div>
    <?php if ($__env->exists('user.partials.scripts')) echo $__env->make('user.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
    <div class="request-loader">
        <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
    </div>
 
</body>

</html>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/layout.blade.php ENDPATH**/ ?>