<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />  
        <link rel="stylesheet" type="text/css" href="/css/main-css.css">
        <script src="/js/main-js.js"></script>
        <script
			src="/js/jquery-3.3.1.min.js"
			integrity=""
			crossorigin="anonymous"></script>
        <title>Stock Your Socks Off</title>
        <link href='https://fonts.googleapis.com/css?family=Crete Round' rel='stylesheet'>
    </head>
    <!-- Titlebar (logo, title, hamburger menu) -->
    <header class = "sysoHeader">
        <div class = "sysoLogo">
            @if(Auth::check())
                <a id = "sysoHomeLink" href = "/account"></a>
            @else
                <a id = "sysoHomeLink" href = "/landing"></a>
            @endif
        </div>
        <div class = "sysoTitle">
            <img class = "sysoTitle" src = "../images/sysoTitle.png" alt = "Stock Your Socks Off"/>
        </div>
        <div class = "sysoHamburger" onclick = "menuClick()">
        </div>
    </header>
    <div id = "sysoGreenBar"></div>
    <!-- Hamburger menu content -->
    <div id = "sysoMenuMaster" class = "sysoMenuMaster" style = "display: none;">
        <ul>
            @yield('link')
        </ul>
    </div>
    <body onload = "monitorPageDimensions()">
        <!-- The sysoContentMaster controls the responsive layout space available for all 
        content. -->
        <div id = "sysoContentMaster" class = "sysoContentMaster" style = "display: block;">
            @yield('content')
            <!-- Footer padding hack - provides padding at the bottom of the content block to 
            compensate for the absolute footer. Don't remove the DIV below! -->
            <div class = "sysoPortrait"></div>
        </div>
    </body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <footer class = "sysoFooter">
        <div>
            <p id = "sysoFooterText">2018 Wolf Pack Of Wall Street Limited ABN 12 345 678</p>
        </div>            
    </footer>
</html>