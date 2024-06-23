"use strict"

var showMini = 0;
var minimize_sidebar = true;
var popup;

function closePrint() {
  if (popup) {
    popup.close();
  }
}

function togsidebar() {

  let w = window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;

  if (w <= 1475) {
    $(".wrapper").addClass('sidebar_minimize');
    $("button.btn.btn-toggle.toggle-sidebar").addClass('toggled');
    $("button.btn.btn-toggle.toggle-sidebar.toggled i").attr('class', 'icon-options-vertical');
    showMini = 1;
  } else if (w <= 991) {
    $(".wrapper").removeClass('sidebar_minimize');
    $("button.btn.btn-toggle.toggle-sidebar").removeClass('toggled');
    $("button.btn.btn-toggle.toggle-sidebar i").attr('class', 'icon-menu');
    showMini = 0;
  } else {
    $(".wrapper").removeClass('sidebar_minimize');
    $("button.btn.btn-toggle.toggle-sidebar").removeClass('toggled');
    $("button.btn.btn-toggle.toggle-sidebar i").attr('class', 'icon-menu');
    showMini = 0;
  }
}

$(document).ready(function () {
  togsidebar();

  $(".btn-toggle").on('click', function () {
    if (showMini == 1) {
      $('.wrapper').removeClass('sidebar_minimize');
      $(".btn-toggle").removeClass('toggled');
      $(".btn-toggle i").attr('class', 'icon-menu');
      showMini = 0;

    } else {

      $('.wrapper').addClass('sidebar_minimize');
      $(".btn-toggle").addClass('toggled');
      $(".btn-toggle i").attr('class', 'icon-options-vertical');
      showMini = 1;
    }

  });
});

$(window).resize(function () {
  togsidebar();
});

$(document).on('click', '.btn-group button.btn', function () {

  $("div.btn-group").find(".btnactive").removeClass("btnactive");
  $(this).addClass("btnactive");

  const x = $("div.btn-group").find(".btnactive").val();
  $("#fileType").val(x);

})


const x = $("div.btn-group").find(".btnactive").val();
$("#fileType").val(x);

$(document).ready(function () {
  if (orders != '0'){

    const form = document.getElementById("salesReportForm");
    const buttons = form.querySelectorAll("button");
  
    buttons.forEach(function (button) {
      button.addEventListener("click", function () {
        const fileType = button.value;
        document.getElementById("fileType").value = fileType;
        form.submit();
      });
    });
  }
});
