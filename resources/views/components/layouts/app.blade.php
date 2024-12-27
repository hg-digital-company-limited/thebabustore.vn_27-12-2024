<!DOCTYPE html>
@php
$settings = App\Models\Setting::first(); // Truy vấn model Settings
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ Storage::url($settings->web_icon)}}" type="image/png">
    <meta name="google" content="notranslate">


    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta name="twitter:url" content="{{ request()->fullUrl() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @livewireStyles
</head>

<body>
    <div class="loading-screen" id="loadingScreen" wire:navigating>
        <div class="loading-spinner"></div>
    </div>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Loading Screen Styles */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Ensure it is on top of other content */
        }

        .loading-spinner {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        document.addEventListener('livewire:navigated', function() {
            // Re-enable scroll after loading
            document.getElementById('loadingScreen').remove();
        });
    
    </script>
    {{ $slot }}

    @livewireScripts
    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
        "default_language": "vi",
        "wrapper_selector": ".gtranslate_wrapper",
        "flag_style":  "3d",
        "alt_flags": { 
            "en": "usa",
        },
        "languages": ["vi", "en"], // Chỉ định các ngôn ngữ cần hỗ trợ
        "language_codes": { "vi": "vi", "en": "en" }, // Đảm bảo tiếng Việt là mặc định
    };

    // Đặt ngôn ngữ mặc định là tiếng Việt
    document.documentElement.lang = "vi";
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets_client/frontend/common/js/slick.min.js?v=1721231848" defer></script>
    <x-livewire-alert::scripts />

    <style>
        .section_product .mobile-viewmore {
            margin-top: 15px;
            font-weight: bold;
            font-family: "Roboto", sans-serif;
        }

        * {
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            letter-spacing: inherit;
        }

        header .nav-item>a {
            color: #1c1c1c;
            font-size: 14px;
            padding: 10px;
            font-weight: bold;
            text-transform: initial;
            letter-spacing: inherit;
            text-align: center;
        }

        .content-box__row:last-child .content-box__row__desc {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            border-bottom-width: 1px;
            text-transform: uppercase;
        }

        .section_product .mobile-viewmore {
            margin-top: 15px;

        }

        .section_product .section-head .title_blog a {
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .section_blogs .mobile-viewmore {
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .section_product .mobile-viewmore {
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        footer.footer .site-footer .footer-widget .list-menu li a {
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .section_product .mobile-viewmore {
            font-weight: 400;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .btn-blues::before,
        #btnnewreview::before,
        .evo-button::before {
            position: absolute;
            content: '';
            display: block;
            left: 0;
            top: 0;
            border-radius: 10px;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
            -webkit-transform-origin: left center;
            transform-origin: left center;
            z-index: -1;
            -webkit-transition: -webkit-transform 0.45s cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transition: -webkit-transform 0.45s cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transition: transform 0.45s cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transition: transform 0.45s cubic-bezier(0.785, 0.135, 0.15, 0.86), -webkit-transform 0.45s cubic-bezier(0.785, 0.135, 0.15, 0.86);
            background-color: #ffffff;
            color: black;
        }

        .section_product .mobile-viewmore {
            font-weight: 400;
            border-radius: 10px;
            font-family: "Roboto", sans-serif;
            color: black;
            text-transform: inherit;
            letter-spacing: initial;
        }

        .section_blogs .mobile-viewmore {
            font-weight: 400;
            border-radius: 10px;
            color: black;
            text-transform: inherit;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        footer.footer .site-footer .footer-widget.footer-subcrible form button {
            width: 100%;
            padding-top: 0;
            padding-bottom: 0;
            /* background-color: black; */
            color: black;
        }

        * {
            font-weight: 400;
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .product-card form .product-card__actions .ajax_addtocart {
            height: 46px;
            font-size: 13px;
            letter-spacing: 1px;
            font-weight: 500;
            flex: 1;
            padding: 0 10px;
            justify-content: center;
            border: 1px solid #1c1c1c;
            background: #fff;
            color: #1c1c1c;
            line-height: 44px;
            font-family: "Roboto", sans-serif;
            border-radius: 10px;
            letter-spacing: initial;
            font-weight: 400;
        }

        .product-card .product-card__inner .product-card__title {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
            font-weight: bold;
        }

        .section_blogs a h3 {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
            font-weight: bold;
        }

        .details-product .details-pro .product-top .title-head {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .details-product .details-pro .product-top .vendor-product {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .details-product .product-tab .tabs-title li {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .evo-blog-header .evo-blog-header-content h1 {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .evo-article .title-head {
            font-family: "Roboto", sans-serif;
            letter-spacing: initial;
        }

        .page-login #login .btn-blues,
        .page-login #customer-reset-password .btn-blues,
        .page-login #recover-password .btn-blues {

            color: black;
        }
        .section_product .section-head .title_blog a strong {
    font-weight: bold;
}
.section_blogs h2 a strong {
    font-weight: bold;
}
button.button.btn.btn-large.btn-block.btn-danger.btn-checkout.evo-button {
    color: black;
    font-family: "Roboto", sans-serif;
    letter-spacing: initial;
}
#right-affix .btn-checkout:hover, #right-affix .btn-checkout:focus {
    background-color: #000000;
    color: #ffffff;
    border-color: #000000;
}
    </style>
</body>

</html>