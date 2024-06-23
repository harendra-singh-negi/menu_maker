<?php
  use App\Constants\Constant;
  use App\Http\Helpers\Uploader;
  use App\Models\User\Bottomlink;
  use App\Models\User\Table;
  use App\Models\User\Ulink;
  use Illuminate\Support\Facades\Auth;

?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($userCurrentLang->rtl == 1 ? 'rtl' : ''); ?>">

<head>

  <?php if($userBs->is_analytics == 1): ?>
     <script async src="//www.googletagmanager.com/gtag/js?id=<?php echo e($userBs->measurement_id); ?>"></script>
        <script>
            "use strict";
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '<?php echo e($userBs->measurement_id); ?>');
        </script>
  <?php endif; ?>


  <meta charset="utf-8">

  <?php if(is_array($packagePermissions) && in_array('PWA Installability',$packagePermissions)): ?>
  <link rel="manifest" crossorigin="use-credentials" href="<?php echo e(request()->root().'/assets/pwa/manifest.json'); ?>" />
  <?php endif; ?>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $__env->yieldContent('meta-description'); ?>">
  <meta name="keywords" content="<?php echo $__env->yieldContent('meta-keywords'); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo $__env->yieldContent('pageHeading'); ?> <?php echo e($userBs->website_title !== null ? '|' . ' ' : ''); ?> <?php echo e($userBs->website_title); ?></title>

  <link rel="shortcut icon" href="<?php echo e($userBs->favicon ? Uploader::getImageUrl(Constant::WEBSITE_FAVICON, $userBs->favicon, $userBs) : ''); ?>"
    type="image/png">


  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/plugin.min.css')); ?>">


  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/default.css')); ?>">

  <?php if(count($allLanguageInfos) == 0): ?>
    <style media="screen">
      .support-bar-area ul.social-links li:last-child {
        margin-right: 0;
      }

      .support-bar-area ul.social-links::after {
        display: none;
      }
    </style>
  <?php endif; ?>
  <?php if($userBs->feature_section == 0): ?>
    <style media="screen">
      .hero-txt {
        padding-bottom: 160px;
      }
    </style>
  <?php endif; ?>

  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/responsive.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/tinymce-content.css')); ?>">
  <link rel="stylesheet"
    href="<?php echo e(asset('assets/front/css/styles.php?color=' . str_replace('#', '', $userBs->base_color))); ?>">
  <?php if($rtl == 1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/rtl.css')); ?>">
  <?php endif; ?>
  <?php if($userBs->is_tawkto == 1 || $userBs->is_whatsapp == 1): ?>
    <style>
      .go-top-area .go-top.active {
        right: auto;
        left: 20px;
      }
    </style>
  <?php endif; ?>
  <?php if($rtl == 0): ?>
    <style>
      .navigation .cart a::before {
        left: 17px;
      }
      .navigation .navbar .navbar-nav .nav-item {
            position: relative;
            margin: 0 15px;
        }
    </style>
  <?php else: ?>

    <style>
      .navigation .cart a::before {
        right: -29px;
      }
      .navigation .navbar .navbar-nav .nav-item {
            position: relative;
            margin: 0 20px;
        }
         .field-input.cross i.fa-times-circle {
                position: absolute;
                color: #000;
                left: 8px;
                top: 16px;
                cursor: pointer;
                text-align: left
            }
            .cart-total-table {
                border: 1px solid #e8e6f4;
                border-radius: 6px;
                margin-bottom: 30px;
                text-align: right
            }
             .cart-total-table li{
           direction:rtl
        }
        
    </style>
  <?php endif; ?>
  <?php echo $__env->yieldContent('style'); ?>


  <script src="<?php echo e(asset('assets/front/js/vendor/modernizr-3.6.0.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/front/js/vendor/jquery.3.2.1.min.js')); ?>"></script>


  <?php if($userBs->is_recaptcha == 1): ?>
    <script type="text/javascript">
      var onloadCallback = function() {
        if ($("#g-recaptcha").length > 0) {
          grecaptcha.render('g-recaptcha', {
            'sitekey': '<?php echo e($userBs->google_recaptcha_site_key); ?>'
          });
        }
      };
    </script>
  <?php endif; ?>


</head>

<body>

  <?php if($userBs->preloader_status == 1): ?>
    <div id="preloader">
      <div class="loader revolve">
        <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRELOADER, $userBs->preloader, $userBs)); ?>"
          alt="">
      </div>
    </div>
  <?php endif; ?>

  <div class="request-loader">
    <img src="<?php echo e(asset('assets/admin/img/loader.gif')); ?>" alt="">
  </div>

  <header class="header-area">
    <div class="navigation">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="support-bar">
              <div class="row">
                <div class="col-xl-6 d-none d-xl-block">
                  <div class="infos">
                    <?php if(!empty($userBs->support_email)): ?>
                      <span>
                        <i class="fas fa-envelope-open-text"></i>
                        <?php echo e(convertUtf8($userBs->support_email)); ?>

                      </span>
                    <?php endif; ?>
                    <?php if(!empty($userBs->support_phone)): ?>
                      <span>
                        <i class="fas fa-phone-alt"></i>
                        <?php echo e(convertUtf8($userBs->support_phone)); ?>

                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-12 col-xl-6 col-12">
                  <div class="links">
                    <?php if(!empty($socialMediaInfos) && $socialMediaInfos->count() > 0): ?>
                      <ul class="social-links">
                        <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><a href="<?php echo e($social->url); ?>" target="_blank"><i class="<?php echo e($social->icon); ?>"></i></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    <?php endif; ?>

                    <?php if(!empty($allLanguageInfos)): ?>
                      <div class="language">
                        <a class="language-btn" href="#"><i class="fas fa-globe-asia"></i>
                          <?php echo e(convertUtf8($userCurrentLang->name)); ?></a>
                        <ul class="language-dropdown">
                          <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <a href='<?php echo e(route('user.front.change.language', [getParam(), $lang->code])); ?>'>
                                <?php echo e(convertUtf8($lang->name)); ?>

                              </a>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                    <?php endif; ?>

                    <?php if(!Auth::guard('client')->check()): ?>
                      <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                        <ul class="login">
                          <li>
                            <a
                              href="<?php echo e(route('user.client.login', getParam())); ?>"><?php echo e($keywords['Login'] ?? __('Login')); ?></a>
                          </li>
                        </ul>
                      <?php endif; ?>
                    <?php else: ?>
                    <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                      <ul class="login">
                        <li>
                          <a
                            href="<?php echo e(route('user.client.dashboard', getParam())); ?>"><?php echo e($keywords['Dashboard'] ?? __('Dashboard')); ?></a>
                        </li>
                      </ul>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($packagePermissions) && in_array('Online Order', $packagePermissions)): ?>
                      <div id="cartQuantity" class="cart">
                        <a href="<?php echo e(route('user.front.cart', getParam())); ?>">
                          <i class="fas fa-cart-plus"></i>
                          <?php
                            $itemsCount = 0;
                            $cart = session()->get(getUser()->username.'_cart');
                            if (!empty($cart)) {
                                foreach ($cart as $p) {
                                    $itemsCount += $p['qty'];
                                }
                            }
                          ?>
                          <span class="cart-quantity"><?php echo e($itemsCount); ?></span>
                        </a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

            <nav class="navbar navbar-expand-lg">
              <?php if($userBs->logo): ?>
                <a class="navbar-brand" href="<?php echo e(route('user.front.index', getParam())); ?>">
                  <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_LOGO, $userBs->logo, $userBs)); ?>"
                    alt="Logo">
                </a>
                <?php else: ?>
                <a class="navbar-brand" href="<?php echo e(route('user.front.index', getParam())); ?>">
                  <img src="<?php echo e(asset('assets/restaurant/images/logo.png')); ?>"
                    alt="Logo">
                </a>
              <?php endif; ?>


              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFive"
                aria-controls="navbarFive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse sub-menu-bar" id="navbarFive">
                <ul class="navbar-nav m-xl-auto mr-auto">
                  <?php
                    $links = json_decode($userMenus, true);
                  ?>

                  <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $href = getUserHref($link, $userCurrentLang->id);
                    ?>

                    <?php if(!array_key_exists('children', $link)): ?>

                      <li class="nav-item">
                        <a class="page-scroll" href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>">
                          <?php echo e($link['text']); ?>

                        </a>
                      </li>
                    <?php else: ?>

                      <li class="nav-item">
                        <a class="page-scroll" href="<?php echo e($href); ?>" target="<?php echo e($link['target']); ?>">
                          <?php echo e($link['text']); ?>

                          <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="sub-menu">
                          <?php $__currentLoopData = $link['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $l2Href = getUserHref($level2, $userCurrentLang->id);
                            ?>
                            <li class="nav-item <?php if(array_key_exists('children', $level2)): ?> submenus <?php endif; ?>">
                              <a class="page-scroll" href="<?php echo e($l2Href); ?>"
                                target="<?php echo e($level2['target']); ?>"><?php echo e($level2['text']); ?></a>


                              <?php
                                if (array_key_exists('children', $level2)) {
                                    create_user_menu($level2, $userCurrentLang->id);
                                }
                              ?>

                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!is_null($packagePermissions) && in_array('Table Reservation', $packagePermissions) && $userBs->is_quote): ?>
                    <li class="nav-item d-block d-sm-none">
                      <a class="page-scroll" href="<?php echo e(route('user.front.reservation', getParam())); ?>">
                        <?php echo e($keywords['Reservation'] ?? __('Reservation')); ?>

                      </a>
                    </li>
                  <?php endif; ?>

                </ul>
              </div>

              <div class="navbar-btns d-flex align-items-center">
                <div class="header-times">
                  <?php if(!is_null($userBs->office_time)): ?>
                    <span>
                      <i class="flaticon-time"></i> <?php echo e($keywords['Opening Time'] ?? __('Opening Time')); ?>

                    </span>
                    <p><?php echo e($userBs->office_time); ?></p>
                  <?php endif; ?>
                </div>
                <?php if(
                    !is_null($packagePermissions) &&
                        in_array('Table Reservation', $packagePermissions) &&
                        $userBs->is_quote): ?>
                  <a class="main-btn main-btn-2 d-none d-sm-inline-block"
                    href="<?php echo e(route('user.front.reservation', getParam())); ?>">
                    <?php echo e($keywords['Reservation'] ?? __('Reservation')); ?>

                  </a>
                <?php endif; ?>
                <?php if(
                    !is_null($packagePermissions) &&
                        in_array('Call Waiter', $packagePermissions) &&
                        $userBs->website_call_waiter == 1): ?>
                  <a class="main-btn main-btn d-none d-sm-inline-block text-white ml-2" data-toggle="modal"
                    data-target="#callWaiterModal">
                    <?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?>

                  </a>
                <?php endif; ?>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>

  <?php echo $__env->yieldContent('content'); ?>

  <?php if ($__env->exists('user-front.partials.popups')) echo $__env->make('user-front.partials.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if($userBs->top_footer_section == 1): ?>
    <footer class="footer-area footer-area-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget-1">
              <div class="header-times d-none d-md-inline-block">
                <?php if(!is_null($userBs->office_time)): ?>
                  <i class="flaticon-time"></i>
                  <h5><?php echo e($keywords['Opening Time'] ?? __('Opening Time')); ?></h5>
                  <span><?php echo e(convertUtf8($userBs->office_time)); ?></span>
                <?php endif; ?>
              </div>
              <p><?php echo e(convertUtf8($userBs->footer_text)); ?></p>


              <ul>
                <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <a href="<?php echo e($social_link->url); ?>" target="_blank">
                      <i class="<?php echo e($social_link->icon); ?>"></i>
                    </a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 order-3 order-lg-2">
            <div class="footer-widget-2 text-left text-sm-center">
              <?php if($userBs->footer_logo): ?>
                <a href="<?php echo e(route('user.front.index', getParam())); ?>">
                  <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->footer_logo, $userBs)); ?>"
                    alt="logo">
                </a>
              <?php endif; ?>
              <ul class="pt-25">
                <?php
                  $blinks = Bottomlink::query()
                      ->where('language_id', $userCurrentLang->id)
                      ->where('user_id', $user->id)
                      ->orderby('id', 'desc')
                      ->get();
                ?>
                <?php $__currentLoopData = $blinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo e($blink->url); ?>" target="_blank"><?php echo e(convertUtf8($blink->name)); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php if(!empty($userBe->footer_bottom_img)): ?>
                <a class="pt-30" href="javascript:void(0);">
                  <img class="lazy"
                    data-src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->footer_bottom_img, $userBs)); ?>"
                    alt="">
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 order-2 order-lg-3">
            <h3 class="subscribe-title"><?php echo e($keywords['Subscribe Here'] ?? __('Subscribe Here')); ?></h3>
            <form id="footerSubscribe" action="<?php echo e(route('user.front.subscribe', getParam())); ?>" method="post"
              class="subscribe-form subscribeForm">
              <?php echo csrf_field(); ?>
              <div class="subscribe-inputs">
                <input name="email" type="text"
                  placeholder="<?php echo e($keywords['Enter Your Email'] ?? __('Enter Your Email')); ?>">
                <button type="submit"><i class="far fa-paper-plane"></i></button>
              </div>
              <p id="erremail" class="text-danger mb-0 err-email"></p>
            </form>
            <div class="footer-widget-3">
              <ul>
                <?php
                  $ulinks = Ulink::query()
                      ->where('language_id', $userCurrentLang->id)
                      ->where('user_id', $user->id)
                      ->orderby('id', 'desc')
                      ->get();
                ?>

                <?php $__currentLoopData = $ulinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo e($ulink->url); ?>" target="_blank">+ <?php echo e(convertUtf8($ulink->name)); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </footer>
  <?php endif; ?>
  <?php if($userBs->copyright_section == 1): ?>
    <div class="footer-copyright-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="footer-copyright d-block justify-content-center d-md-flex">
              <div class="tinymce-content">
                <?php echo $userBs->copyright_text; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="go-top-area">
    <div class="go-top-wrap">
      <div class="go-top-btn-wrap">
        <div class="go-top go-top-btn">
          <i class="fa fa-angle-double-up"></i>
          <i class="fa fa-angle-double-up"></i>
        </div>
      </div>
    </div>
  </div>

  <div id="WAButton"></div>

  <?php
    $cookieStatus = $userBe->cookie_alert_status == 1;
    $cookieName = str_replace(' ', '_', $userBs->website_title . '_' . $user->username);
    $cookieName = strtolower($cookieName) . '_cookie';

    \Config::set('cookie-consent.enabled', $cookieStatus);
    \Config::set('cookie-consent.cookie_name', $cookieName);
  ?>

  <div class="cookie">
    <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

  <div class="modal fade" id="callWaiterModal" tabindex="-1" role="dialog" aria-labelledby="callWaiterModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
            $tables = Table::query()
                ->where('status', 1)
                ->where('user_id', $user->id)
                ->get();
          ?>
          <form id="callWaiterForm" action="<?php echo e(route('user.front.call.waiter', getParam())); ?>" method="GET">
            <select class="form-control" name="table" required>
              <option value="" disabled selected><?php echo e($keywords['Select a Table'] ?? __('Select a Table')); ?>

              </option>
              <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($table->table_no); ?>"><?php echo e($keywords['Table'] ?? __('Table')); ?> -
                  <?php echo e($table->table_no); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="callWaiterForm" class="btn base-btn text-white">
            <?php echo e($keywords['Call Waiter'] ?? __('Call Waiter')); ?>

          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    "use strict";
    const mainurl = "<?php echo e(url('/')); ?>";
    let userCheckoutUrl = "<?php echo e(route('user.front.add.cart', [getParam(), ':id'])); ?>";
    const lat = '<?php echo e($userBs->latitude); ?>';
    const sessionLang = '<?php echo e(session()->get("user_lang")); ?>';
    const currentLang = '<?php echo e($userCurrentLang->code); ?>';
    const lng = '<?php echo e($userBs->longitude); ?>';
    const rtl = <?php echo e($rtl); ?>;
    const position = "<?php echo e($userBe->base_currency_symbol_position); ?>";
    const symbol = "<?php echo e($userBe->base_currency_symbol); ?>";
    const textPosition = "<?php echo e($userBe->base_currency_text_position); ?>";
    const currText = "<?php echo e($userBe->base_currency_text); ?>";
    const vap_pub_key = "<?php echo e($userBex->VAPID_PUBLIC_KEY); ?>";
    const pathName = "<?php echo e(getParam()); ?>";
    var demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";

    const offlineImg = "<?php echo e(public_path('/assets/front/img/offline.png')); ?>";
    let select = "<?php echo e($keywords['Select'] ?? __('Select')); ?>";

  </script>

<script>
var datepickerpath = "<?php echo e(asset('assets/tenant/js/i18n/'.$userCurrentLang->datepicker_name.'-' . $userCurrentLang->code . '.js')); ?>";
   $(function() {

    $.getScript(datepickerpath)
        .done(function() {

            $("input.datepicker").datepicker({
                minDate: 0,
                dayNames: $.datepicker.regional[currentLang].dayNames,
                monthNames: $.datepicker.regional[currentLang].monthNames,

            });
        })
        .fail(function() {

        });

});
</script>


  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>


  <script src="<?php echo e(asset('assets/front/js/plugin.min.js')); ?>"></script>
  <?php if(is_array($packagePermissions) && in_array('PWA Installability',$packagePermissions)): ?>

  <script src="<?php echo e(asset('assets/front/js/pwa.js')); ?>" defer></script>
  <?php endif; ?>

  <script src="<?php echo e(asset('assets/front/js/misc.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/main.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/cart.js')); ?>"></script>

    <?php if($userBs->is_facebook_pixel == 1): ?>
        <!-- Meta Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?php echo e($userBs->pixel_id); ?>');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=<?php echo e($userBs->pixel_id); ?>&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
    <?php endif; ?>



    <?php if($userBs?->disqus_shortname && $userBs->is_disqus == 1): ?>
    <script>
        "use strict";
        (function() {
            var d = document, s = d.createElement('script');
            s.src = '//<?php echo e($userBs->disqus_shortname); ?>.disqus.com/embed.js';
            s.setAttribute('data-timestamp', + new Date());
            (d.head  || d.body).appendChild(s);
        })();
    </script>
    <?php endif; ?>

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
  </script>

  <?php echo $__env->yieldContent('script'); ?>

  <?php if(session()->has('success')): ?>
    <script>
      "use strict";
      toastr["success"]("<?php echo e(__(session('success'))); ?>");
    </script>
  <?php endif; ?>

  <?php if(session()->has('warning')): ?>
    <script>
      "use strict";
      toastr["warning"]("<?php echo e(__(session('warning'))); ?>");
    </script>
  <?php endif; ?>

  <?php if(session()->has('error')): ?>
    <script>
      "use strict";
      toastr["error"]("<?php echo e(__(session('error'))); ?>");
    </script>
  <?php endif; ?> 

 <?php if($userBs->is_tawkto == 1): ?>
        <!--Start of Tawk.to Script-->
    
        <script type="text/javascript">
      
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="<?php echo e($userBs->tawkto_direct_chat_link); ?>";;
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>

        <!--End of Tawk.to Script-->
    <?php endif; ?>



</body>

</html>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user-front/layout.blade.php ENDPATH**/ ?>