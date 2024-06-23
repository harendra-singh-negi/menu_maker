@php
  use App\Constants\Constant;
  use App\Http\Helpers\Uploader;
  use App\Models\User\Bottomlink;
  use App\Models\User\Table;
  use App\Models\User\Ulink;
  use Illuminate\Support\Facades\Auth;

@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ $userCurrentLang->rtl == 1 ? 'rtl' : ''}}">

<head>

  @if ($userBs->is_analytics == 1)
     <script async src="//www.googletagmanager.com/gtag/js?id={{ $userBs->measurement_id }}"></script>
        <script>
            "use strict";
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '{{ $userBs->measurement_id }}');
        </script>
  @endif


  <meta charset="utf-8">

  @if(is_array($packagePermissions) && in_array('PWA Installability',$packagePermissions))
  <link rel="manifest" crossorigin="use-credentials" href="{{ request()->root().'/assets/pwa/manifest.json' }}" />
  @endif
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="@yield('meta-description')">
  <meta name="keywords" content="@yield('meta-keywords')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('pageHeading') {{ $userBs->website_title !== null ? '|' . ' ' : '' }} {{ $userBs->website_title }}</title>

  <link rel="shortcut icon" href="{{ $userBs->favicon ? Uploader::getImageUrl(Constant::WEBSITE_FAVICON, $userBs->favicon, $userBs) : '' }}"
    type="image/png">


  <link rel="stylesheet" href="{{ asset('assets/front/css/plugin.min.css') }}">


  <link rel="stylesheet" href="{{ asset('assets/front/css/default.css') }}">

  @if (count($allLanguageInfos) == 0)
    <style media="screen">
      .support-bar-area ul.social-links li:last-child {
        margin-right: 0;
      }

      .support-bar-area ul.social-links::after {
        display: none;
      }
    </style>
  @endif
  @if ($userBs->feature_section == 0)
    <style media="screen">
      .hero-txt {
        padding-bottom: 160px;
      }
    </style>
  @endif

  <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tinymce-content.css') }}">
  <link rel="stylesheet"
    href="{{ asset('assets/front/css/styles.php?color=' . str_replace('#', '', $userBs->base_color)) }}">
  @if ($rtl == 1)
    <link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
  @endif
  @if ($userBs->is_tawkto == 1 || $userBs->is_whatsapp == 1)
    <style>
      .go-top-area .go-top.active {
        right: auto;
        left: 20px;
      }
    </style>
  @endif
  @if ($rtl == 0)
    <style>
      .navigation .cart a::before {
        left: 17px;
      }
      .navigation .navbar .navbar-nav .nav-item {
            position: relative;
            margin: 0 15px;
        }
    </style>
  @else

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
  @endif
  @yield('style')


  <script src="{{ asset('assets/front/js/vendor/modernizr-3.6.0.min.js') }}"></script>
  <script src="{{ asset('assets/front/js/vendor/jquery.3.2.1.min.js') }}"></script>


  @if ($userBs->is_recaptcha == 1)
    <script type="text/javascript">
      var onloadCallback = function() {
        if ($("#g-recaptcha").length > 0) {
          grecaptcha.render('g-recaptcha', {
            'sitekey': '{{ $userBs->google_recaptcha_site_key }}'
          });
        }
      };
    </script>
  @endif


</head>

<body>

  @if ($userBs->preloader_status == 1)
    <div id="preloader">
      <div class="loader revolve">
        <img src="{{ Uploader::getImageUrl(Constant::WEBSITE_PRELOADER, $userBs->preloader, $userBs) }}"
          alt="">
      </div>
    </div>
  @endif

  <div class="request-loader">
    <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
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
                    @if (!empty($userBs->support_email))
                      <span>
                        <i class="fas fa-envelope-open-text"></i>
                        {{ convertUtf8($userBs->support_email) }}
                      </span>
                    @endif
                    @if (!empty($userBs->support_phone))
                      <span>
                        <i class="fas fa-phone-alt"></i>
                        {{ convertUtf8($userBs->support_phone) }}
                      </span>
                    @endif
                  </div>
                </div>
                <div class="col-lg-12 col-xl-6 col-12">
                  <div class="links">
                    @if (!empty($socialMediaInfos) && $socialMediaInfos->count() > 0)
                      <ul class="social-links">
                        @foreach ($socialMediaInfos as $social)
                          <li><a href="{{ $social->url }}" target="_blank"><i class="{{ $social->icon }}"></i></a>
                          </li>
                        @endforeach
                      </ul>
                    @endif

                    @if (!empty($allLanguageInfos))
                      <div class="language">
                        <a class="language-btn" href="#"><i class="fas fa-globe-asia"></i>
                          {{ convertUtf8($userCurrentLang->name) }}</a>
                        <ul class="language-dropdown">
                          @foreach ($allLanguageInfos as $key => $lang)
                            <li>
                              <a href='{{ route('user.front.change.language', [getParam(), $lang->code]) }}'>
                                {{ convertUtf8($lang->name) }}
                              </a>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    @if (!Auth::guard('client')->check())
                      @if (!empty($packagePermissions) && in_array('Online Order', $packagePermissions))
                        <ul class="login">
                          <li>
                            <a
                              href="{{ route('user.client.login', getParam()) }}">{{ $keywords['Login'] ?? __('Login') }}</a>
                          </li>
                        </ul>
                      @endif
                    @else
                    @if (!empty($packagePermissions) && in_array('Online Order', $packagePermissions))
                      <ul class="login">
                        <li>
                          <a
                            href="{{ route('user.client.dashboard', getParam()) }}">{{ $keywords['Dashboard'] ?? __('Dashboard') }}</a>
                        </li>
                      </ul>
                    @endif
                    @endif
                    @if (!empty($packagePermissions) && in_array('Online Order', $packagePermissions))
                      <div id="cartQuantity" class="cart">
                        <a href="{{ route('user.front.cart', getParam()) }}">
                          <i class="fas fa-cart-plus"></i>
                          @php
                            $itemsCount = 0;
                            $cart = session()->get(getUser()->username.'_cart');
                            if (!empty($cart)) {
                                foreach ($cart as $p) {
                                    $itemsCount += $p['qty'];
                                }
                            }
                          @endphp
                          <span class="cart-quantity">{{ $itemsCount }}</span>
                        </a>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <nav class="navbar navbar-expand-lg">
              @if ($userBs->logo)
                <a class="navbar-brand" href="{{ route('user.front.index', getParam()) }}">
                  <img src="{{ Uploader::getImageUrl(Constant::WEBSITE_LOGO, $userBs->logo, $userBs) }}"
                    alt="Logo">
                </a>
                @else
                <a class="navbar-brand" href="{{ route('user.front.index', getParam()) }}">
                  <img src="{{ asset('assets/restaurant/images/logo.png') }}"
                    alt="Logo">
                </a>
              @endif


              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFive"
                aria-controls="navbarFive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse sub-menu-bar" id="navbarFive">
                <ul class="navbar-nav m-xl-auto mr-auto">
                  @php
                    $links = json_decode($userMenus, true);
                  @endphp

                  @foreach ($links as $link)
                    @php
                      $href = getUserHref($link, $userCurrentLang->id);
                    @endphp

                    @if (!array_key_exists('children', $link))

                      <li class="nav-item">
                        <a class="page-scroll" href="{{ $href }}" target="{{ $link['target'] }}">
                          {{ $link['text'] }}
                        </a>
                      </li>
                    @else

                      <li class="nav-item">
                        <a class="page-scroll" href="{{ $href }}" target="{{ $link['target'] }}">
                          {{ $link['text'] }}
                          <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="sub-menu">
                          @foreach ($link['children'] as $level2)
                            @php
                              $l2Href = getUserHref($level2, $userCurrentLang->id);
                            @endphp
                            <li class="nav-item @if (array_key_exists('children', $level2)) submenus @endif">
                              <a class="page-scroll" href="{{ $l2Href }}"
                                target="{{ $level2['target'] }}">{{ $level2['text'] }}</a>


                              @php
                                if (array_key_exists('children', $level2)) {
                                    create_user_menu($level2, $userCurrentLang->id);
                                }
                              @endphp

                            </li>
                          @endforeach
                        </ul>
                      </li>
                    @endif
                  @endforeach
                  @if (!is_null($packagePermissions) && in_array('Table Reservation', $packagePermissions) && $userBs->is_quote)
                    <li class="nav-item d-block d-sm-none">
                      <a class="page-scroll" href="{{ route('user.front.reservation', getParam()) }}">
                        {{ $keywords['Reservation'] ?? __('Reservation') }}
                      </a>
                    </li>
                  @endif

                </ul>
              </div>

              <div class="navbar-btns d-flex align-items-center">
                <div class="header-times">
                  @if (!is_null($userBs->office_time))
                    <span>
                      <i class="flaticon-time"></i> {{ $keywords['Opening Time'] ?? __('Opening Time') }}
                    </span>
                    <p>{{ $userBs->office_time }}</p>
                  @endif
                </div>
                @if (
                    !is_null($packagePermissions) &&
                        in_array('Table Reservation', $packagePermissions) &&
                        $userBs->is_quote)
                  <a class="main-btn main-btn-2 d-none d-sm-inline-block"
                    href="{{ route('user.front.reservation', getParam()) }}">
                    {{ $keywords['Reservation'] ?? __('Reservation') }}
                  </a>
                @endif
                @if (
                    !is_null($packagePermissions) &&
                        in_array('Call Waiter', $packagePermissions) &&
                        $userBs->website_call_waiter == 1)
                  <a class="main-btn main-btn d-none d-sm-inline-block text-white ml-2" data-toggle="modal"
                    data-target="#callWaiterModal">
                    {{ $keywords['Call Waiter'] ?? __('Call Waiter') }}
                  </a>
                @endif
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>

  @yield('content')

  @includeIf('user-front.partials.popups')

  @if ($userBs->top_footer_section == 1)
    <footer class="footer-area footer-area-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget-1">
              <div class="header-times d-none d-md-inline-block">
                @if (!is_null($userBs->office_time))
                  <i class="flaticon-time"></i>
                  <h5>{{ $keywords['Opening Time'] ?? __('Opening Time') }}</h5>
                  <span>{{ convertUtf8($userBs->office_time) }}</span>
                @endif
              </div>
              <p>{{ convertUtf8($userBs->footer_text) }}</p>


              <ul>
                @foreach ($socialMediaInfos as $social_link)
                  <li>
                    <a href="{{ $social_link->url }}" target="_blank">
                      <i class="{{ $social_link->icon }}"></i>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="col-lg-6 order-3 order-lg-2">
            <div class="footer-widget-2 text-left text-sm-center">
              @if ($userBs->footer_logo)
                <a href="{{ route('user.front.index', getParam()) }}">
                  <img src="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBs->footer_logo, $userBs) }}"
                    alt="logo">
                </a>
              @endif
              <ul class="pt-25">
                @php
                  $blinks = Bottomlink::query()
                      ->where('language_id', $userCurrentLang->id)
                      ->where('user_id', $user->id)
                      ->orderby('id', 'desc')
                      ->get();
                @endphp
                @foreach ($blinks as $blink)
                  <li><a href="{{ $blink->url }}" target="_blank">{{ convertUtf8($blink->name) }}</a></li>
                @endforeach
              </ul>
              @if (!empty($userBe->footer_bottom_img))
                <a class="pt-30" href="javascript:void(0);">
                  <img class="lazy"
                    data-src="{{ Uploader::getImageUrl(Constant::WEBSITE_IMAGE, $userBe->footer_bottom_img, $userBs) }}"
                    alt="">
                </a>
              @endif
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 order-2 order-lg-3">
            <h3 class="subscribe-title">{{ $keywords['Subscribe Here'] ?? __('Subscribe Here') }}</h3>
            <form id="footerSubscribe" action="{{ route('user.front.subscribe', getParam()) }}" method="post"
              class="subscribe-form subscribeForm">
              @csrf
              <div class="subscribe-inputs">
                <input name="email" type="text"
                  placeholder="{{ $keywords['Enter Your Email'] ?? __('Enter Your Email') }}">
                <button type="submit"><i class="far fa-paper-plane"></i></button>
              </div>
              <p id="erremail" class="text-danger mb-0 err-email"></p>
            </form>
            <div class="footer-widget-3">
              <ul>
                @php
                  $ulinks = Ulink::query()
                      ->where('language_id', $userCurrentLang->id)
                      ->where('user_id', $user->id)
                      ->orderby('id', 'desc')
                      ->get();
                @endphp

                @foreach ($ulinks as $ulink)
                  <li><a href="{{ $ulink->url }}" target="_blank">+ {{ convertUtf8($ulink->name) }}</a></li>
                @endforeach
              </ul>

            </div>
          </div>
        </div>
      </div>
    </footer>
  @endif
  @if ($userBs->copyright_section == 1)
    <div class="footer-copyright-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="footer-copyright d-block justify-content-center d-md-flex">
              <div class="tinymce-content">
                {!! $userBs->copyright_text !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

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

  @php
    $cookieStatus = $userBe->cookie_alert_status == 1;
    $cookieName = str_replace(' ', '_', $userBs->website_title . '_' . $user->username);
    $cookieName = strtolower($cookieName) . '_cookie';

    \Config::set('cookie-consent.enabled', $cookieStatus);
    \Config::set('cookie-consent.cookie_name', $cookieName);
  @endphp

  <div class="cookie">
    @include('cookie-consent::index')
  </div>

  <div class="modal fade" id="callWaiterModal" tabindex="-1" role="dialog" aria-labelledby="callWaiterModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ $keywords['Call Waiter'] ?? __('Call Waiter') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @php
            $tables = Table::query()
                ->where('status', 1)
                ->where('user_id', $user->id)
                ->get();
          @endphp
          <form id="callWaiterForm" action="{{ route('user.front.call.waiter', getParam()) }}" method="GET">
            <select class="form-control" name="table" required>
              <option value="" disabled selected>{{ $keywords['Select a Table'] ?? __('Select a Table') }}
              </option>
              @foreach ($tables as $table)
                <option value="{{ $table->table_no }}">{{ $keywords['Table'] ?? __('Table') }} -
                  {{ $table->table_no }}
                </option>
              @endforeach
            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="callWaiterForm" class="btn base-btn text-white">
            {{ $keywords['Call Waiter'] ?? __('Call Waiter') }}
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    "use strict";
    const mainurl = "{{ url('/') }}";
    let userCheckoutUrl = "{{ route('user.front.add.cart', [getParam(), ':id']) }}";
    const lat = '{{ $userBs->latitude }}';
    const sessionLang = '{{ session()->get("user_lang") }}';
    const currentLang = '{{ $userCurrentLang->code }}';
    const lng = '{{ $userBs->longitude }}';
    const rtl = {{ $rtl }};
    const position = "{{ $userBe->base_currency_symbol_position }}";
    const symbol = "{{ $userBe->base_currency_symbol }}";
    const textPosition = "{{ $userBe->base_currency_text_position }}";
    const currText = "{{ $userBe->base_currency_text }}";
    const vap_pub_key = "{{ $userBex->VAPID_PUBLIC_KEY }}";
    const pathName = "{{ getParam() }}";
    var demo_mode = "{{ env('DEMO_MODE') }}";

    const offlineImg = "{{ public_path('/assets/front/img/offline.png') }}";
    let select = "{{ $keywords['Select'] ?? __('Select') }}";

  </script>

<script>
var datepickerpath = "{{ asset('assets/tenant/js/i18n/'.$userCurrentLang->datepicker_name.'-' . $userCurrentLang->code . '.js') }}";
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


  <script src="{{ asset('assets/front/js/plugin.min.js') }}"></script>
  @if(is_array($packagePermissions) && in_array('PWA Installability',$packagePermissions))

  <script src="{{ asset('assets/front/js/pwa.js') }}" defer></script>
  @endif

  <script src="{{ asset('assets/front/js/misc.js') }}"></script>

  <script src="{{ asset('assets/front/js/main.js') }}"></script>

  <script src="{{ asset('assets/front/js/cart.js') }}"></script>

    @if ($userBs->is_facebook_pixel == 1)
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
            fbq('init', '{{ $userBs->pixel_id }}');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $userBs->pixel_id }}&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
    @endif



    @if($userBs?->disqus_shortname && $userBs->is_disqus == 1)
    <script>
        "use strict";
        (function() {
            var d = document, s = d.createElement('script');
            s.src = '//{{$userBs->disqus_shortname}}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', + new Date());
            (d.head  || d.body).appendChild(s);
        })();
    </script>
    @endif

  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
  </script>

  @yield('script')

  @if (session()->has('success'))
    <script>
      "use strict";
      toastr["success"]("{{ __(session('success')) }}");
    </script>
  @endif

  @if (session()->has('warning'))
    <script>
      "use strict";
      toastr["warning"]("{{ __(session('warning')) }}");
    </script>
  @endif

  @if (session()->has('error'))
    <script>
      "use strict";
      toastr["error"]("{{ __(session('error')) }}");
    </script>
  @endif 

 @if ($userBs->is_tawkto == 1)
        <!--Start of Tawk.to Script-->
    
        <script type="text/javascript">
      
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="{{ $userBs->tawkto_direct_chat_link}}";;
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>

        <!--End of Tawk.to Script-->
    @endif



</body>

</html>
