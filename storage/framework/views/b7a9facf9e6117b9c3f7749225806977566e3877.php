<?php
    use App\Models\User\Language;
    $userId = getRootUser()->id;
    $setLang = Language::query()->where([
        ['code', request()->input('language')],
        ['user_id',$userId]
    ])->first();
?>
<?php if(!empty($setLang) && $setLang->rtl == 1): ?>
<?php $__env->startSection('styles'); ?>
<style>
    form:not(.modal-form.create) input,
    form:not(.modal-form.create) textarea,
    form:not(.modal-form.create) select {
        direction: rtl;
    }

    form:not(.modal-form.create) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
<?php if(request()->routeIs('user.contact')): ?>
<style>
    form:not(.modal-form) input {
        direction: ltr;
    }
</style>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/rtl-style.blade.php ENDPATH**/ ?>