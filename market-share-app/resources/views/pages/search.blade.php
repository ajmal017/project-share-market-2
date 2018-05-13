@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='account'>Home</a>
        <a class = "sysoLink" href='community'>Community</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='landing'>Home</a>
        <a class = "sysoLink" href='signin'>Login</a>
        <a class = "sysoLink" href='signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='about'>About</a>
@endsection

@section('content')
<script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <!--{{--  <div id="container" style="width:100%; height:400px;"></div>  --}}-->
    <div class = "sysoBox sysoBoxFlex sysoCenterText">
        <div class = "sysoContent sysoContent50">
            <h1 class = "sysoHeader1">Enter an ASX Code</h1>
            <input type="text" name="asx_code" id="asx_code" maxlength="3">
            <input type="button" value="Search" id="search_companies">
            <p class = "sysoHeader1">Or</p>
            <h1 class = "sysoHeader1">Start typing a Company Name</h1>
            <input type="text" name="company_name" id="company_name">
        </div>
        <div class = "sysoContent sysoContent50">
            <h1 class = "sysoHeader1">Search Results</h1>
            <!--<select id="company_name_dropdown" name="company_name_dropdown">
                <option disabled>Make a selection</option>
            </select>-->
            <div id="company_details"></div>
            <div id="get_daily_data"></div>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection