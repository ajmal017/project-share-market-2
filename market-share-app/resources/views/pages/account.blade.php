@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='/account/'>Home</a>
        <a class = "sysoLink" href='/search/'>Search</a>
        <a class = "sysoLink" href='/community/'>Community</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='/landing/'>Home</a>
        <a class = "sysoLink" href='/signin/'>Login</a>
        <a class = "sysoLink" href='/signup/'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='about'>About/FAQ</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
        

        <script type='text/javascript'>
            function unhideButtons(number) {
                var confirm = GEBI("confirm" + number);
                var cancel = GEBI("cancel" + number);
                var sell = GEBI("sell" + number);
                confirm.style.display = "block";
                cancel.style.display = "block";
                sell.style.display = "none";
            }

            function hideButtons(number) {
                var confirm = GEBI("confirm" + number);
                var cancel = GEBI("cancel" + number);
                var sell = GEBI("sell" + number);
                confirm.style.display = "none";
                cancel.style.display = "none";
                sell.style.display = "block";
            }
        </script>

        <?php
            if (isset($fid)){
                $user = $fid;
            }
            else {
                $user = Auth::user()->id;
            }
            $curruser = DB::table('users')->where('id', $user)->get();
        ?>
        
        <div class = "sysoBox sysoBoxFlex" id = "sysoAccount">
            <div class = "sysoContent sysoContent50">
                <!-- <h1 class = "sysoAuth" id="accHeader">Welcome {{ Auth::user()->name }}!</h1> -->
                <h1 class = "sysoAuth" id="accHeader">{{$curruser[0]->name}}'s Account</h1>
                <?php
                    use App\Http\Controllers\AdminController;
                    if(AdminController::isAdmin()) {
                        echo "<p><a class = 'sysoLink' href='/admin'>Admin Page</a></p>";
                    }

                    if (!isset($fid)){
                        echo "<p><a class = 'sysoLink' href='/search'>Search Listings</a></p>";
                    }
                ?>
                
                <div class="shareDetails">
                <?php
                    // sells shares once form has been submitted
                    use App\Http\Controllers\MarketDataController;
                    use App\Http\Controllers\ShareTransactionController;
                    ShareTransactionController::updateEquity();
                    if (isset($_GET['sell'])) {
                        if (!ShareTransactionController::sellShares($_GET['sell'])) {
                            echo "Error! Cannot sell shares in that listing. Please try again";
                        }
                    }

                ?>
                    <h1>Share Portfolio</h1>
                    <table id = "shareTable">
                        <tr id = "tableHeader">
                            <th>Name</th>
                            <th>Code</th>
                            <th>Shares</th>
                            <th>Value</th> 
                            <th>Change</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        <?php                    
                            
                            // query userid in open transactions table
                            $overallcost = 0.00;
                            $overallvalue = 0.00;
                            $totalshares = 0;
                            $json = DB::table('open_transactions')->where('user_id', '=', $user)
                                ->get();
                            $data = json_decode($json);
                            if(empty($data)) {
                                echo "<tr><td colspan='7'>No shares currently held. Bought shares will appear here.</td></tr>";
                            } else {
                                $count = 0;
                                // echo out each transaction
                                foreach ($data as $line) {
                                    // calls the hourly API and gets most recent result
                                    // very messy sorry
                                    // might clean it up later
                                    $companyjson = DB::table('asx_company_details')->where('company_code', '=',$line->asx_code)
                                        ->get();
                                    $companydata = json_decode($companyjson);
                                    $url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=" . $line->asx_code . ".ax&interval=60min&apikey=PEQIWLTYB0GPLMB8";
                                    $call = MarketDataController::curlStocksStats($url);
                                    $asxdata = json_decode($call, true);
                                    $name = 'Time Series (60min)';
                                    $name2 = '4. close';
                                    $array = $asxdata[$name];
                                    $keys = array_keys($array);
                                    $newarr = $array[$keys[0]];
                                    $currentprice = floatval($newarr[$name2]);
                                    $origprice = floatval($line->purchase_price);
                                    $origtotalcost = $origprice*($line->quantity)+($line->buying_commission);
                                    $overallcost += $origtotalcost;
                                    $newtotalprice = $currentprice*$line->quantity;
                                    $overallvalue += $newtotalprice;
                                    $totalshares += $line->quantity;

                                    $diff = $currentprice-$origprice;
                                    echo "<tr>";
                                    echo "<td><a id='coName' href='/listing/".strtoupper($line->asx_code)."'>".$companydata[0]->company_name."</a></td>";
                                    echo "<td>".strtoupper($line->asx_code)."</td>";
                                    // might need to change this later to aggregate quantities
                                    echo "<td>".$line->quantity."</td>";
                                    echo "<td>"."$".number_format($currentprice,2,'.',',')."</td>";
                                    echo "<td>$".number_format($diff,2,'.',',')."</td>";
                                    echo "<td>$".number_format($newtotalprice-$origtotalcost,2,'.',',') ."</td>";
                                    if (!isset($fid)){
                                        echo "<td><div id='sell".$count."'><form action='/account' method='get'><button type='button' onclick='unhideButtons(".$count.")'>Sell</button></div>";
                                        echo "<div id='confirm".$count."' style='display: none;'><button type='submit' name='sell' value='".strtoupper($line->asx_code)."'>Confirm</button></form></div>";
                                        echo "<div id='cancel".$count."' style='display: none;'><button type='button' onclick='hideButtons(".$count.")'>Cancel</button></div></td>";
                                    }
                                    else{
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                    $count++;

                                }
                            
                                echo "<tr></tr><tr id = 'tableHeader'><td colspan='5'>Total</td>";
                                echo "<td>$".number_format($overallvalue-$overallcost,2,'.',',')."</td></tr>";
                            }        
                        ?>
                    </table>
                </div>

                

            </div>

            <div class = "sysoContent sysoContent50">
                <br/>

                <div class = "userDetails">
                    <h1>My Account</h1>
                    <table id = "userTable">
                        <tr>
                            <th id = "tableHeader">Account Balance</th>
                            <td><?php echo "$".number_format($curruser[0]->account_balance,2,'.',','); ?></td>
                            <!--<td>{{ Auth::user()->account_balance }}</td>-->
                        </tr>
                        <tr>
                            <th id = "tableHeader">Shares Held</th>
                            <td><?php echo $totalshares;?></td>
                        </tr>
                        <tr>
                            <th id = "tableHeader">Share Value</th>
                            <td><?php echo "$".number_format($overallvalue,2,'.',',');?></td>
                        </tr>
                        <tr>
                            <th id = "tableHeader">Total Profit/Loss</th>
                            <td><?php echo "$".number_format($overallvalue-$overallcost,2) ?></td>
                        </tr>
                        <tr>
                            <th id = "tableHeader">Total Asset Value</th>
                            <td><?php echo "$".number_format($curruser[0]->account_balance+$overallvalue,2,'.',','); ?></td>
                            
                    </table>
                </div>
                
                </br>
                <div class="friends">
                    <h1>Recent Transactions</h1>
                    <table class="friendList">
                        <tr id = "tableHeader">
                            <th>Code</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th>Commission</th>
                            <th>Date</th>
                        </tr>

                        <?php 
                            //List of last 5 Closed Transaactions
                            $closed=DB::table('closed_transactions')->where('user_id', $user)->get();
                            $data=$closed->sortByDesc('date_closed')->take(5);
                            foreach ($data as $line) {
                                $code=($line->asx_code);
                                $quantity=($line->quantity);
                                $sold=($line->sold_price);
                                $commission=($line->selling_commission);
                                $date=($line->date_closed);
                                echo "<tr>";
                                echo "<td>".$code."</td>";
                                echo "<td>".$quantity."</td>";
                                echo "<td>"."$".number_format($sold,2,'.',',')."</td>";
                                echo "<td>"."$".number_format($commission,2,'.',',')."</td>";
                                echo "<td>".date('d-m-Y', strtotime($date))."</td>";
                                echo "</tr>";
                            }
                        ?>

                    </table>
                </div>

                <!-- <p><a class = "sysoLink" href='/community'>Community</a></p> -->

                </br>
                <div class="friends">
                    <h1>Top 5 Friends</h1>
                    <table class="friendList">
                        <tr id = "tableHeader">
                            <th>Name</th>
                            <th>Equity</th>
                            <th>Balance</th>
                            <th>Transactions</th>
                            <th>Updated</th>
                        </tr>

                        <?php 
                            //List of Friends
                            $friends=DB::table('users')->join('friends', 'users.id', '=', 'friends.friend_id')
                                ->select('users.*', 'friends.friend_id')->where('friends.user_id', $user)->get();
                            $data=$friends->sortByDesc('equity')->take(5);
                            foreach ($data as $line) {
                                $fid=($line->friend_id);
                                $name=($line->name);
                                $equity=($line->equity);
                                $balance=($line->account_balance);
                                $trans = DB::table('closed_transactions')->where('user_id', $fid)->count('id');
                                $updated=($line->updated_at);
                                echo "<tr>";
                                echo "<td><a href='/account/".$fid."' onclick='retAccount(".$fid.")'>".$name."</a></td>";
                                echo "<td>"."$".number_format($equity,2,'.',',')."</td>";
                                echo "<td>"."$".number_format($balance,2,'.',',')."</td>";
                                echo "<td>".$trans."</td>";
                                echo "<td>".date('d-m-Y', strtotime($updated))."</td>";
                                echo "</tr>";
                            }
                        ?>

                    </table>
                </div>

            </div>

        </div>

    <!-- END OF CONTENT -->

@endsection