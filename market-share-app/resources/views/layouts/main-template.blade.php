<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/main-css.css">
        <script src="/js/main-js.js"></script>
        <script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
        <title>Stock Your Socks Off</title>
    </head>
<<<<<<< HEAD
    <header>
        <div id="logo">
            <a href="/"><img id="sysoimg" src="/images/SYSOlogo2.png" align="left"/></a>
=======
    <!-- Titlebar (logo, title, hamburger menu) -->
    <header class = "sysoHeader">
        <div class = "sysoLogo">
            <a id = "sysoHomeLink" href = "/landing"></a>
>>>>>>> master
        </div>
        <div class = "sysoTitle">
            <img id = "sysoTitle" src = "../images/sysoTitle.png" alt = "Stock Your Socks Off"/>
        </div>
        <div class = "sysoHamburger" onclick = "menuClick()">
        </div>
    </header>
    <!-- Hamburger menu content -->
    <div id = "sysoMenuMaster" class = "sysoMenuMaster blackBox" style = "display: none;">
        <ul>
            @yield('link')
        </ul>
    </div>
    <body>
        <!-- The sysoContentMaster controls the responsive layout space available for all 
        content. -->
        <div id = "sysoContentMaster" class = "sysoContentMaster" style = "display: block;">
            @yield('content')
            <!-- Footer padding hack - provides padding at the bottom of the content block to 
            compensate for the absolute footer. Don't remove the DIV below! -->
            <div class = "sysoPortrait"></div>
        </div>
    </body>
    <footer class = "sysoFooter">
        <div>
            <p id = "sysoFooterText">2018 Wolf Pack Of Wall Street Limited ABN 12 345 678</p>
        </div>            
    </footer>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</html>