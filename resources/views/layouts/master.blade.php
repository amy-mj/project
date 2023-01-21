<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name  = "viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title> <!-- 페이지 타이틀 영역 -->
        <!-- Favicon -->
        <link rel   = "shortcut icon" href="{{ asset('assets/img/svg/logo.svg') }}" type="image/x-icon">
        <!-- Custom styles -->
        <link rel   = "stylesheet" href="{{ asset('assets/css/style.min.css') }}">
        <link href  = "{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
        <script src = "//code.jquery.com/jquery-latest.min.js"></script>
        @yield('header_css_js') <!--  페이지에 사용될 CSS와 JS를 임폴트 하는 영역 -->
    </head>
    <body>
        <div class="layer"></div>
        <!-- ! Body -->
        <a class    = "skip-link sr-only" href="#skip-target">Skip to content</a>
        <div class  = "page-flex">
            @yield('header') <!--  헤더 영역 -->
                <!-- ! Main Content -->
            <main class = "main users chart-page" id="skip-target">
                @yield('container') <!--  콘텐츠 영역 -->       
            </main>
            @yield('footer') <!--  푸터 영역 -->
        </div>
            @yield('import_js') <!--  스크립트 영역 -->
    </body>
</html>