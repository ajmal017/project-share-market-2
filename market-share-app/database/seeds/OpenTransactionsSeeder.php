<?php

use Illuminate\Database\Seeder;

class OpenTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('open_transactions')->insert([
            'user_id' => '1',
            'is_short_selling' => 0,
            'asx_code' => 'wow',
            'date_opened' => date("2018-04-10 10:00:00"),
            'purchase_price' => 26.93,
            'quantity' => 1000,
            'buying_commission' => 319.30
        ]);

        DB::table('open_transactions')->insert([
            'user_id' => '1',
            'is_short_selling' => 0,
            'asx_code' => 'cwn',
            'date_opened' => date("2018-04-10 10:00:00"),
            'purchase_price' => 12.70,
            'quantity' => 500,
            'buying_commission' => 63.5
        ]);
    }
}
