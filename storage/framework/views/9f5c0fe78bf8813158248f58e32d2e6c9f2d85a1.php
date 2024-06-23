<div class="js-cookie-consent cookie-consent">

    <div class="container">
      <div class="cookie-container">
        <span class="cookie-consent__message">
          <?php echo nl2br(replaceBaseUrl(convertUtf8($userBe->cookie_alert_text))); ?>

        </span>

        <button class="js-cookie-consent-agree cookie-consent__agree">
            <?php echo e($userBe->cookie_alert_button_text); ?>

        </button>
      </div>
    </div>

</div>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/vendor/cookie-consent/dialogContents.blade.php ENDPATH**/ ?>