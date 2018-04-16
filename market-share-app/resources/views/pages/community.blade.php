@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

                <div class="friends">
                    <h1>Top 10</h1>
                    <table class="friendList">
                    <tr id = "tableHeader">
                        <th>Name</th>
                        <th>Total Worth</th>
                        <th>Friend</th>
                    </tr>
                     
                     <?php 
                            use App\User;
                            // query userid in open transactions table
                            //SELECT * FROM articles ORDER BY rating DESC LIMIT 10
                            $users = DB::table('users')->get();
                            $json = $users->sortByDesc('account_balance')->take('10');
                            $data = json_decode($json);
                            $name=null;
                            $balance=0.00;
                            foreach ($data as $line) {
                                $name=($line->name);
                                $balance=($line->account_balance);
                                echo "<tr>";
                                echo "<td>".$name."</td>";
                                echo "<td>".$balance."</td>";
                                echo "<td><input type='checkbox' name='friend' {{ old('friend') ? 'checked' : '' }}></td>";
                                echo "</tr>";
                            }
                        ?>

                    </table>
                </div>

    <!-- END OF CONTENT -->

@endsection