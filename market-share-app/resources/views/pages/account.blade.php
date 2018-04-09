@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href='/search'>Search Listings</a>
    <a class = "sysoLink" href='about'>About/FAQ</a>
    <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
        
        <div class = "sysoBox sysoBoxFlex" id = "sysoAccount">
            <div class = "sysoContent sysoContent50">
            <h1 class = "sysoAuth" id="accHeader">Welcome {{ Auth::user()->name }}!</h1>
            <br></br>
            <div class = "userDetails">
                <h1>My Account</h1>
                <table id = "userTable">
                    <tr>
                        <th id = "tableHeader">Account Balance</th>
                        <td>{{ Auth::user()->account_balance }}</td>
                    </tr>
                    <tr>
                        <th id = "tableHeader">Shares Held</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th id = "tableHeader">Share Value</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th id = "tableHeader">Total Profit/Loss</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th id = "tableHeader">Total Asset Value</th>
                        <td>XXX</td>
                </table>
            </div>
            </br>
            <div class="friends">
                <h1>Friends</h1>
                <table class="friendList">
                <tr id = "tableHeader">
                    <th>Name</th>
                    <th>Total Worth</th>
                    <th>Profit/Loss</th>
                </tr>
                <tr>
                    <td id="friendName"><a href="javascript:void(0)">John</td>
                    <td>$1,000,500</td>
                    <td>+$500</td>
                </tr>
                <tr>
                    <td id="friendName"><a href="javascript:void(0)">Paul</td>
                    <td>$900,000</td>
                    <td>-$100,000</td>
                </tr>
                <tr>
                    <td id="friendName"><a href="javascript:void(0)">Ringo</td>
                    <td>$1,000,001</td>
                    <td>+$1</td>
                </tr>
                <tr>
                    <td id="friendName"><a href="javascript:void(0)">George</td>
                    <td>$500,000</td>
                    <td>-$500,000</td>
                </tr>
                </table>
            </div>
        </div>
        <div class = "sysoContent sysoContent50">
            <br></br>
            <div class="shareDetails">
                <h1>Share Portfolio</h1>
                <table id = "shareTable">
                    <tr id = "tableHeader">
                        <th>Company Name</th>
                        <th>Company Code</th>
                        <th>Current Share Value</th>
                        <th>Shares Held</th>
                        <th>Change</th>
                        <th>Total Profit/Loss</th>
                    </tr>
                    <tr>
                        <td>XYZ Incorporated</td>
                        <td>XYZ</td>
                        <td>$6.01</td>
                        <td>800</td>
                        <td>+$0.46</td>
                        <td>+$368</td>
                        <td><a href="javascript:void(0)">Sell</a>
                    </tr>
                    <tr>
                        <td>Kelly Industries</td>
                        <td>JRK</td>
                        <td>$5.01</td>
                        <td>1050</td>
                        <td>-$45.01</td>
                        <td>-$47,292</td>
                        <td><a href="javascript:void(0)">Sell</a>
                    </tr>
                    <tr></tr>
                    <tr id = "tableHeader">
                        <td colspan="3">Total<td>
                        <td>-$44.55</td>
                        <td>-$46,924</td>
                    </tr>  
                </table>
            </div>

            <br></br>

            <p><a class = "sysoLink" href='/search'>Search Listings</a></p>
            
            <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    <!-- END OF CONTENT -->

@endsection