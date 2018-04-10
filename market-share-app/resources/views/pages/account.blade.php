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
                <p><a class = "sysoLink" href='/search'>Search Listings</a></p>
                
                <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
            <div class = "sysoContent sysoContent50">
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
                            <th/>
                        </tr>
                        <?php 
                            use App\Http\Controllers\MarketDataController;
                            // query userid in open transactions table
                            $json = DB::table('open_transactions')->where('user_id', '=', Auth::user()->id)
                                ->get();
                            $data = json_decode($json);

                            // echo out each transaction
                            foreach ($data as $line) {
                                $url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=" . $line->asx_code . ".ax&interval=1min&apikey=PEQIWLTYB0GPLMB8";
                                $call = MarketDataController::curlStocksStats($url);
                                $asxdata = json_decode($call, true);
                                //$test = json_decode($asxdata->{'Time Series (1min)'});
                                //print_r($asxdata['Time Series (1min)']);
                                $name = 'Time Series (1min)';
                                $name2 = '4. close';
                                $array = $asxdata[$name];
                                $keys = array_keys($array);
                                //print_r($array[$keys[0]]);
                                $newarr = $array[$keys[0]];
                                $currentprice = $newarr[$name2];
                                echo "<tr>";
                                echo "<td>"."UNKNOWN"."</td>";
                                echo "<td>".strtoupper($line->asx_code)."</td>";
                                echo "<td>".$currentprice."</td>";
                                // might need to change this later to aggregate quantities
                                echo "<td>".$line->quantity."</td>";
                                echo "<td>"."na"."</td>";
                                echo "<td>"."na" ."</td>";
                                echo "</tr>";
                                

                            }
                        
                        ?>
                        <tr></tr>
                        <tr id = "tableHeader">
                            <td colspan="4">Total</td>
                            <td>-$44.55</td>
                            <td>-$46,924</td>
                            <td/>
                        </tr>  
                    </table>
                </div>
                <br/>
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
                <br/>
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
        </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    <!-- END OF CONTENT -->

@endsection