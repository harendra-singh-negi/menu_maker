<?php
    use App\Models\User\Language;
    $userId = getRootUser()->id;
    $userDefaultLang = Language::query()
    ->where([
        ['user_id',$userId],
        ['is_default',1]
    ])->first();
    $userLanguages = Language::query()->where('user_id',$userId)->get();
   
?>
<?php if(!is_null($userDefaultLang)): ?>
    <?php if(!empty($userLanguages)): ?>
        <select name="userLanguage" class="form-control"
                onchange="window.location='<?php echo e(url()->current() . '?language='); ?>'+this.value">
            <option value="" selected disabled><?php echo e(__('Select a Language')); ?></option>
            <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($lang->code); ?>" <?php echo e($lang->code == request()->input('language') ? 'selected' : ''); ?>><?php echo e($lang->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/languages.blade.php ENDPATH**/ ?>