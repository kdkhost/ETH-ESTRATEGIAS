<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @php $setting = App\Models\Setting::find($currentLang->id); @endphp

    @if($setting->loader_status == 1) 
        <script type="text/javascript">
            window.paceOptions = { ajax: false, restartOnRequestAfter: false, restartOnPushState: false};
        </script>
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-adsense-account" content="ca-pub-3150896617677590">

    <!-- Motor de SEO Global -->
    @include('includes.seo')

    @if($setting->analytics_switch == 1)

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$setting->analytics}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{$setting->analytics}}');
    </script>
    
    @endif
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3150896617677590"
     crossorigin="anonymous"></script>

    @if($setting->facebook_pixel_switch == 1)

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{$setting->facebook_pixel}}');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id={{$setting->facebook_pixel}}&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    
    @endif
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{$setting->favicon}}" type="image/x-icon">
    <link rel="icon" href="{{$setting->favicon}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    
    @if($currentLang->rtl == 1) 
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @else 
        <link href="{{$setting->font}}" rel="stylesheet">
    @endif

    @if($setting->maintenance_status == 0) 

        @if($setting->loader_status == 1) 
            <script type='text/javascript' src="{{ asset('js/front/pace.min.js') }}" id='pace-js'></script>
            <script> setTimeout(function () {Pace.stop();},4500);</script>
        @endif

     @endif

        <!-- Styles -->
        <link href="{{ asset('css/front/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/libs/fontawesome.min.css')}}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/front/owl.carousel.min.css')}}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/front/venor.css') }}" type="text/css" rel="stylesheet">

     

        @yield('styles')

        @if($currentLang->rtl == 1) 
            <link href="{{ asset('css/front/rtl.css') }}" type="text/css" rel="stylesheet">
        @endif


        <!-- Inline Styles -->
        <style>
            body {
                @if($currentLang->rtl == 1) 
                    font-family: 'Cairo', sans-serif;
                @else 
                    font-family: 'Poppins', sans-serif;
                @endif
            }

            @if($setting->custom_css)
                {!! $setting->custom_css !!}
            @endif

            @if($setting->loader_status == 1) 
                .pace-cover {
                    background-image: url({!! $setting->loader_img !!});
                    background-color: {!! $setting->loader_color !!};
                }
            @endif


        </style>
    

</head>
<body class="common-front @if($currentLang->rtl == 1) rtl @endif" @if($currentLang->rtl == 1) dir="rtl" @endif>
    
    @if($setting->maintenance_status == 1) 

        <div class="maintenance_cls"><div class="maintenance_inner">{!!$setting->maintenance_text!!}</div></div>

    @endif

    @if($setting->maintenance_status == 0) 

    <!-- body -->

    @if($setting->loader_status == 1) 
    <div class="pace-cover"></div>
    @endif


    <header class="header">

        

        <div class="header__content__venor">
            <div class="header__logo">
                <a href="{{url('/')}}" title="{{$setting->title}}">
                    <img style="width:auto; height:60px; display: block; filter: none; -webkit-filter: none;" class="img-fluid logo-front" src="{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}" alt="logo">
                </a>
            </div>

            <div class="header__actions__venor">

                @if($headerfooter->sidebar_title2)
                <div class="header__action">
                    <a  class="header__action-btn header__action-btn--start-project" href="{{$headerfooter->sidebar_description2}}">
                        {{$headerfooter->sidebar_title2}} <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg>
                    </a>
                </div>
                @endif

                @if($headerfooter->sidebar_title)
                <div class="header__action">
                    <a  class="header__action-btn header__action-btn--start-project" href="{{$headerfooter->sidebar_description}}">
                        {{$headerfooter->sidebar_title}} <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg>
                    </a>
                </div>
                @endif


             
                
                <div class="header__lang">

                    @if (!empty($currentLang) && count($langs) > 1)
   
                        <ul class="header__lang-list" >
            
                            @foreach ($langs as $key => $lang)
                                
                            <li @if ($currentLang->code == $lang->code) class="active" @endif><a title="{{$lang->name}}"  href='{{ route('changeLanguage', $lang->code) }}'><span>{{$lang->code}}</span></a></li>
                            @endforeach
                        </ul>
                    @endif

                </div>

                
            </div>

            
        </div>
    </header>

    <div class="header-burger">
        <div class="burger">  <span></span> <span></span> <span></span> </div>
    </div>

    <div class="fixed-sidebar-menu-overlay" style="opacity: 0;"></div>

    <div class="fixed-sidebar-menu-holder header7">
        <div class="fixed-sidebar-menu">
            <div class="header7 sidebar-content">
                <div class="left-side">

                    <div class="left-side-inner">

                        <div class="flx-div">
                            <img src="/public/img/sidebar-img.svg" alt="sidebar-img.svg" >
                        </div>

                        <div class="header__menu__venor">
                            <ul class="header__nav">

                                @foreach( $menus->sortBy('order') as $prod )
                                   
                                    @if($prod->on_off_submenu == 1)
                                       <li class="header__nav-item dropdown">
                                            <a class="header__nav-link dropdown-toggle" href="{{$prod->link}}"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$prod->name}}
                                            </a>
                                            {!! $prod->submenu !!}
                                           
                                        </li>
                                    @else 
                                         <li class="header__nav-item"> <a title="{{$prod->name}}" class="header__nav-link" href="{{$prod->link}}">{{$prod->name}}</a> </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>

                        <div class="menu-description">
                            {!!$headerfooter->sidebar_menu_description!!}
                        </div>

                        <div class="header-social-share">
                            {!!$headerfooter->social_links!!}
                        </div>


                        <div class="address-sidebar">
                            <div><img width="16" height="16" src="/public/img/map-pin.svg" alt="map-pin.svg" > {!!$setting->address!!}</div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    @yield('content')

    <div class="typed-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                        <h4 class="parent-typed-text">
                        <span class="mt_typed-beforetext">{{$headerfooter->typed_title}} </span>
                            <span class="mt_typed_text"></span>

                        </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{$headerfooter->typed_buttonlink}}" target="_self" class="btn btn-style1"><span>{{$headerfooter->typed_buttontext}}</span><svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg></a>
                </div>
            </div>
        </div>
    </div>   


    <footer class="footer-section">
        <div class="footer-wrapper">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="footer-left">
                        <div class="inner">
                            <span>{{$headerfooter->footer_col1_subtitle}}</span>
                            <h4>{{$headerfooter->footer_col1_title}}</h4>
                            <a class="btn btn-style2" href="{{$headerfooter->footer_col1_buttonlink}}"> <span>{{$headerfooter->footer_col1_buttontext}}</span> <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg></a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-right">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="footer-widget">
                                    <div class="footer-widget widget_nav_menu">
                                        <h4 class="title">{{$headerfooter->footer_col2_title1}}</h4>
                                        <span class="venor-animate-border"></span>
                                        <div class="menu-quick-link-container">
                                            {!!$headerfooter->footer_col2_html1!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="footer-widget">
                                    <div class="widget widget_custom_html">
                                        <h4 class="title">{{$headerfooter->footer_col2_title2}}</h4>
                                        <span class="venor-animate-border"></span>
                                        <div class="custom-html-widget">
                                            {!!$headerfooter->footer_col2_html2!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="copyright-text">
                                    {!!$headerfooter->footer_copyright!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
  




    @if($setting->SchmeaORG_switch == 1)

    <div class="hidden"  itemscope="" itemtype="https://schema.org/LocalBusiness">
        <span itemprop="description">@yield('meta')</span> 
        <a itemprop="url" href="{{route('home')}}"> </a>
        <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        <img src="{{route('home')}}{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}" alt="logo" width="120" itemprop="url"></div>
        <span itemprop="name">{{$setting->title}}</span>
        <em><span itemprop="priceRange">{{$setting->price_range}}</span></em>
        <div itemprop="address" itemscope="" itemtype="https://schema.org/PostalAddress"> 
            <span itemprop="addressLocality">{{$setting->address}}</span> | 
            <span itemprop="addressCountry">{{$setting->country}}</span> | 
            <span itemprop="telephone">{{$setting->phone}}</span> | 
            <span itemprop="email">{{$setting->contact}}</span>
        </div>
    </div> 

    @endif


    @if($setting->whatsapp == 1)
    <style>
    .whatsapp-premium-box { position: fixed; bottom: 90px; right: 30px; width: 320px; background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); z-index: 9999; opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s ease; overflow: hidden; font-family: 'Inter', sans-serif; }
    .whatsapp-premium-box.active { opacity: 1; visibility: visible; transform: translateY(0); }
    .wa-header { background: linear-gradient(135deg, #25D366, #128C7E); color: #fff; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
    .wa-header-info { font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
    .wa-close { background: rgba(255,255,255,0.2); border: none; color: #fff; font-size: 20px; cursor: pointer; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; transition: 0.2s; }
    .wa-close:hover { background: rgba(255,255,255,0.4); }
    .wa-body { padding: 20px; background: #e5ddd5; }
    .wa-message { background: #fff; padding: 12px 16px; border-radius: 0 12px 12px 12px; font-size: 14px; color: #444; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: inline-block; }
    .wa-message p { margin: 0; }
    .wa-footer { padding: 15px 20px; background: #fff; }
    .wa-button { display: block; background: #25D366; color: #fff; text-align: center; padding: 12px; border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 15px; transition: 0.2s; }
    .wa-button:hover { background: #128C7E; color: #fff; }
    .chat__trigger-quin.logo-chat { cursor: pointer; background: #25D366; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4); border: 2px solid #fff; transition: all 0.3s ease; animation: wa-pulse 2s infinite; }
    .chat__trigger-quin.logo-chat:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6); }
    .chat__trigger-quin.logo-chat svg { fill: #fff; width: 35px; height: 35px; }
    @keyframes wa-pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }
    </style>
    <div class="whatsapp-premium-box" id="wa-premium-box">
        <div class="wa-header">
            <div class="wa-header-info">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.01 2.011c-5.513 0-9.99 4.478-9.99 9.99 0 1.956.556 3.824 1.54 5.437L2 22l4.7-1.222a9.92 9.92 0 0 0 5.31 1.528h.003c5.513 0 9.99-4.478 9.99-9.991C22 6.495 17.523 2.011 12.01 2.011zm0 16.634c-1.636 0-3.238-.426-4.654-1.233l-.334-.198-3.46.906.924-3.376-.217-.346a8.318 8.318 0 0 1-1.272-4.453c0-4.606 3.748-8.354 8.354-8.354 4.606 0 8.353 3.748 8.353 8.354 0 4.606-3.747 8.354-8.353 8.354z" fill="#fff"/>
                    <path d="M16.657 13.064c-.255-.128-1.503-.74-1.737-.826-.233-.085-.403-.128-.574.128-.17.255-.658.826-.807.997-.15.17-.298.19-.553.064-.255-.128-1.072-.395-2.042-1.258-.755-.672-1.264-1.503-1.413-1.758-.15-.255-.016-.393.111-.52.115-.115.255-.298.383-.447.128-.15.17-.255.255-.426.085-.17.043-.319-.021-.447-.064-.128-.574-1.383-.787-1.894-.207-.497-.417-.43-.574-.438-.15-.008-.319-.008-.489-.008-.17 0-.447.064-.681.319s-.894.872-.894 2.128c0 1.255.915 2.468 1.043 2.638.128.17 1.8 2.744 4.361 3.829 2.562 1.085 2.562.723 3.03.681.468-.043 1.503-.613 1.716-1.205.213-.591.213-1.097.15-1.205-.064-.106-.234-.17-.489-.298z" fill="#fff"/>
                </svg> Fale Conosco
            </div>
            <button class="wa-close" onclick="document.getElementById('wa-premium-box').classList.remove('active')">&times;</button>
        </div>
        <div class="wa-body">
            <div class="wa-message">
                <p>Olá! 👋 Como podemos ajudar você hoje?</p>
            </div>
        </div>
        <div class="wa-footer">
            <a href="https://wa.me/{{$setting->phone}}" target="_blank" class="wa-button">
                Iniciar Conversa
            </a>
        </div>
    </div>
    <div class="chat__trigger-quin logo-chat" onclick="document.getElementById('wa-premium-box').classList.toggle('active')" title="Fale pelo WhatsApp">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .018 5.393 0 12.03c0 2.12.553 4.189 1.602 6.04L0 24l6.117-1.605a11.803 11.803 0 005.925 1.585h.005c6.635 0 12.03-5.393 12.033-12.03a11.75 11.75 0 00-3.525-8.514z"/>
        </svg>
    </div>
    @endif
    

    <script src="{{ asset('js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('js/front/popper.min.js') }}"></script>
    <script src="{{ asset('js/front/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/front/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/front/simpleParallax.min.js') }}" defer></script>
    <script src="{{ asset('js/front/countTO.js') }}" defer></script>
    <script src="{{ asset('js/front/typed.min.js') }}" defer></script>
    <script src="{{ asset('js/front/shuffleLetters.js') }} " defer></script>
    <script src="{{ asset('js/front/magnific.min.js') }}" defer></script>
    <script src="{{ asset('js/front/scrollreveal.min.js') }}" defer></script>
    <script src="{{ asset('js/front/venor.js') }}" defer></script>

    <svg width="0" height="0" display="none" xmlns="http://www.w3.org/2000/svg">
        <symbol id="arrow" xmlns="http://www.w3.org/2000/svg" width="11.4" height="9.2"><path d="M11.3 4.1L8.1.2c-.3-.2-.7-.3-1 0-.3.2-.3.6-.1.9l2.3 2.8H.7c-.4 0-.7.3-.7.7 0 .4.3.7.7.7h8.6L7 8c-.2.3-.2.8.1 1 .3.2.7.2 1-.1L11.3 5c.2-.3.2-.6 0-.9z"/></symbol>
        <symbol id="chat" xmlns="http://www.w3.org/2000/svg" width="30.2" height="30.2" viewBox="0 0 30.2 30.2" style="enable-background:new 0 0 30.2 30.2"><path d="M15.1 29c-2.5 0-5-.7-7.2-2l-.2-.1-5.1 1.5c-.2.1-.4 0-.5-.1-.2-.1-.2-.3-.2-.5l1.5-5.1-.1-.2c-1.3-2.2-2-4.7-2-7.3 0-7.7 6.2-13.9 13.9-13.9S29 7.4 29 15.1C29 22.8 22.7 29 15.1 29zm0-29C6.8 0 0 6.8 0 15.1c0 2.7.7 5.3 2 7.6l.1.1-1.3 4.6c-.2.6 0 1.2.4 1.7.4.4 1.1.6 1.7.4l4.7-1.3.1.1c2.3 1.3 4.9 2 7.5 2 8.3 0 15.1-6.8 15.1-15.1S23.4 0 15.1 0z"/><path d="M7.7 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.4 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1s2.1-.9 2.1-2.1c0-1.2-1-2.1-2.1-2.1zM14.8 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.3 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1s2.1-.9 2.1-2.1c0-1.2-.9-2.1-2.1-2.1zM21.8 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.4 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1 1.1 0 2.1-.9 2.1-2.1-.1-1.2-1-2.1-2.1-2.1z"/></symbol>
        <symbol id="scroll" xmlns="http://www.w3.org/2000/svg" width="15" height="22.1"><path class="st0" d="M7.5 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 9.8c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 6.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 3.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 0c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1C6.4.5 6.9 0 7.5 0zM7.5 19.8c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM4.2 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM10.6 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM1.9 13.5c.4.4.4 1.2 0 1.6-.4.4-1.2.4-1.6 0-.4-.4-.4-1.2 0-1.6.5-.4 1.2-.4 1.6 0M4.3 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM14.7 13.5c.4.4.4 1.2 0 1.6-.4.4-1.2.4-1.6 0-.4-.4-.4-1.2 0-1.6.4-.4 1.1-.4 1.6 0M10.7 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1z"/></symbol>

    </svg>


    @include('cookie-consent::index')



 

    <script type="text/javascript">
    ( function ( $ ) {
        'use strict';
        $( document ).ready( function () {
            /* TYPED TEXT */
            $(function(){
                $(".mt_typed_text").typed({
                  strings: {!! $headerfooter->typed_text !!}, //blade / php dynamic functionality
                  typeSpeed: 60, // Slower for typewriter feel
                  backSpeed: 30,
                  backDelay: 4000,
                  loop: true,
                  contentType: 'html' // Allow HTML for colored words
                });
            });

            /* SHUFFLE LETTERS SLIDER */
            $(function(){
                $('.slider-venor').on('change.owl.carousel', function(event) {
                    $(".slider-venor h1, .slider-venor h2, .slider-venor .slider-body").removeClass('active');
                });

                function applyTypewriter(element) {
                    var $this = $(element);
                    var text = $this.data('original-text') || $this.text().trim();
                    
                    // Armazena o texto original se ainda não o fez
                    if (!$this.data('original-text')) {
                        $this.data('original-text', text);
                    }

                    if (text.length > 0) {
                        $this.text('');
                        var i = 0;
                        var speed = 100;
                        function type() {
                            if (i < text.length) {
                                $this.append(text.charAt(i));
                                i++;
                                setTimeout(type, speed);
                            }
                        }
                        type();
                    }
                }

                // Observer para textos fora do slider (scroll)
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            applyTypewriter(entry.target);
                            // Se quiser que anime apenas uma vez por "aparição", não precisa dar unobserve
                            // Se quiser que re-anime ao voltar, o applyTypewriter já reseta o texto
                        }
                    });
                }, { threshold: 0.5 });

                // Alvos globais de texto vazado (Incluindo H2 direto para o slider)
                $("h1 span, h2, h2 span, h3 span, h1.banner-title span, .typed-section .mt_typed-beforetext").each(function() {
                    observer.observe(this);
                });

                $('.slider-venor').on('translated.owl.carousel', function(event) {
                    var activeItem = $(".slider-venor .owl-item.active");
                    activeItem.find("h1, h2, .slider-body").addClass('active');
                    
                    // Aplica efeito Typewriter nos textos vazados (spans ou h2 direto)
                    activeItem.find("h1 span, h2, h2 span").each(function() {
                        applyTypewriter(this);
                    });
                });
            });
        })
    } ( jQuery ) )
    </script>

    @if($setting->custom_css)
        <script type="text/javascript">
            {!! $setting->custom_js !!} //blade / php dynamic functionality
        </script>
    @endif



    @yield('scripts')


    <!-- body -->

    @endif



</body>
</html>
