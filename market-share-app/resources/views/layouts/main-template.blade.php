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
    <header>
        <div id="logo">
            <a href="landing"><img id="sysoimg" src="/images/SYSOlogo2.png" align="left"/></a>
        </div>
        <div id="nav">
            <p>testing</p>
        </div>
    </header>
    <body>
        @yield('content')
    </body>
    <footer>
            <div>
                <p>2018 Wolf Pack Of Wall Street Limited ABN 12 345 678</p>
            </div>            
    </footer>
</html>