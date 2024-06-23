$(function ($) {

  "use strict";

  $(document).on('change', '#cover_image', function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();
    reader.onload = function (e) {
      $('.coverImg img').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  })

  $(document).on('change', '#intro_main_image', function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
      $('.showIntroMainImage img').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  })
  $(document).on('change', '#intro_signature', function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
      $('.showImage img').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  })
  $(document).on('change', '#intro_video_image', function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
      $('.intro_video_image img').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  })

  $(document).ready(function () {
    const today = new Date();
    $("#deadline").datepicker({
      autoclose: true,
      endDate: today,
      todayHighlight: true
    });
  });

  $(".remove-image").on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    let type = $(this).data('type');
    let fd = new FormData();
    fd.append('type', type);
    fd.append('language_id', langCode);
    if (typeof feature_id !== 'undefined'){
      fd.append('feature_id', feature_id);
    }
    if (typeof pcategory_id !== 'undefined') {
      fd.append('pcategory_id', pcategory_id);
    }

    $.ajax({
      url: routeUrl,
      data: fd,
      type: 'POST',
      contentType: false,
      processData: false,
      success: function (data) {
        if (data === "success") {
          window.location = currentUrl + '?language=' + langCode;
        }
      }
    })
  });

  function toggleMessage(status) {
    if (status == 1) {
      $("#message").show();
    } else {
      $("#message").hide();
    }
  }

  $(document).ready(function () {
    $('.ordertimepicker').mdtimepicker();

    toggleMessage($("select[name='order_close']").val());

    $("select[name='order_close']").on('change', function () {
      let status = $(this).val();
      toggleMessage(status);
    });
  });

  $(document).ready(function () {
    $(".addTF").on('click', function (e) {
      e.preventDefault();
      $("#createModal").modal('show');
      $("input[name='day']").val($(this).data('day'));
    })
  });

  $("#sortable").sortable({
    stop: function (event, ui) {
      $(".request-loader").addClass('show');
      let fd = new FormData();
      $(".ui-state-default.ui-sortable-handle").each(function (index) {
        fd.append('ids[]', $(this).data('id'));
        let order = parseInt(index) + 1
        fd.append('orders[]', order);
      });
      $.ajax({
        url: orderUpdateRoute,
        method: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
          $(".request-loader").removeClass('show');

        }
      })
    }
  });
  $("#sortable").disableSelection();

});
