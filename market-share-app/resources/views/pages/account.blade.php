@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href='about'>About/FAQ</a>
    <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <p>
        
        <div id = "temporaryBox">
            <h1 class = "sysoAuth">Welcome {{ Auth::user()->name }}!</h1>
            <div class = "userDetails">
                <table>
                    <tr>
                        <th>Account Balance</th>
                        <td>{{ Auth::user()->account_balance }}</td>
                    </tr>
                    <tr>
                        <th>Shares Held</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th>Share Value</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th>Total Profit/Loss</th>
                        <td>XXX</td>
                    </tr>
                    <tr>
                        <th>Total Asset Value</th>
                        <td>XXX</td>
                </table>
            </div>
            <br><br>
            <div class="shareDetails">
                <table>
                    <tr>
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
                    <tr>
                        <td colspan="3">Total<td>
                        <td>-$44.55</td>
                        <td>-$46,924</td>
                    </tr>
                    
                </table>
                <br><br>
                <table class="friendList">
                <tr>
                    <th>Name</th>
                    <th>Total Worth</th>
                    <th>Profit/Loss</th>
                </tr>
                <tr>
                    <td><a href="javascript:void(0)">John</td>
                    <td>$1,000,500</td>
                    <td>+$500</td>
                </tr>
                <tr>
                    <td><a href="javascript:void(0)">Paul</td>
                    <td>$900,000</td>
                    <td>-$100,000</td>
                </tr>
                <tr>
                    <td><a href="javascript:void(0)">Ringo</td>
                    <td>$1,000,001</td>
                    <td>+$1</td>
                </tr>
                <tr>
                    <td><a href="javascript:void(0)">George</td>
                    <td>$500,000</td>
                    <td>-$500,000</td>
                </tr>
                </table>
                <br><br>
            
            
            </div>
            
            <a id="logoutLink" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <p><a href='/search'>Search Listings</a></p>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
</p>
    <!-- END OF CONTENT -->

@endsection