<script>
  "use strict";
  var mainurl =  "<?php echo e(url('/')); ?>";
  var imgupload = "<?php echo e(route('admin.summernote.upload')); ?>";
  var storeUrl = "";
  var removeUrl = "";
  var rmvdbUrl = "";
  var loadImgs = "";
  var audio = new Audio("<?php echo e(asset('assets/front/files/new-order-notification.mp3')); ?>");
  var waiterCallAudio = new Audio("<?php echo e(asset('assets/front/files/call-waiter.mp3')); ?>");
  var pusherAppKey = "<?php echo e($userBe->pusher_app_key ?? ''); ?>";
  var pusherCluster = "<?php echo e($userBe->pusher_app_cluster ?? ''); ?>";
  var userStatusRoute = "<?php echo e(route('user.status')); ?>";
  var timezone = "<?php echo e($userBe->timezone ?? ''); ?>";
 var demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";

</script>

<script src="<?php echo e(asset('assets/admin/js/core/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/vue/vue.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/vue/axios.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/core/bootstrap.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/tenant/js/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jquery-ui-1.13.2.custom/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jquery.timepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/mdtimepicker/mdtimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/sweetalert/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/dropzone/jquery.dropzone.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jquery.dm-uploader/jquery.dm-uploader.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/jscolor/jscolor.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugin/lazyload.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/pusher.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/atlantis.min.js')); ?>"></script>

<script>
    var sessionSubcategory = "<?php echo e(session()->get('subcategory')); ?>";
</script>

<script src="<?php echo e(asset('assets/tenant/js/custom.js')); ?>"></script>
<?php if(!empty($packagePermissions) &&  in_array('Live Orders',$packagePermissions )): ?>
  <script src="<?php echo e(asset('assets/front/js/realtime.js')); ?>"></script>
<?php elseif(  in_array('Call Waiter',$packagePermissions )): ?>
  <script src="<?php echo e(asset('assets/front/js/realtime.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->yieldContent('variables'); ?>

<script src="<?php echo e(asset('assets/admin/js/misc.js')); ?>"></script>

<script>
    $("#toggle-btn").on('change', function() {
        var value= null;
        if(this.checked){
            value = this.getAttribute('data-on');
        }else{
            value =this.getAttribute('data-off');
        }
        $.post(userStatusRoute,
            {
                value: value
            },
            function(data){
                history.go(0);
            });
    });
</script>

<?php echo $__env->yieldContent('scripts'); ?>

<?php echo $__env->yieldContent('vuescripts'); ?>

<?php if(session()->has('success')): ?>
<script>
  "use strict";
  var content = {};

  content.message = '<?php echo e(session('success')); ?>';
  content.title = 'Success';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'success',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });

</script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
<script>
  "use strict";
  var content = {};

  content.message = '<?php echo e(session('warning')); ?>';
  content.title = 'Warning!';
  content.icon = 'fa fa-bell';

  $.notify(content,{
    type: 'warning',
    placement: {
      from: 'top',
      align: 'right'
    },
    showProgressbar: true,
    time: 1000,
    delay: 4000,
  });
</script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <script>
        "use strict";
        toastr["error"]("<?php echo e(__(session('error'))); ?>");
    </script>
<?php endif; ?>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/partials/scripts.blade.php ENDPATH**/ ?>