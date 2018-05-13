<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;

class AsxCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this one for the live server
        $csv = Reader::createFromPath(getcwd()."/ASXListedCompanies.csv", 'r');

        //this one for the local server
        // $csv = Reader::createFromPath(getcwd()."\public\ASXListedCompanies.csv", 'r');
        $csv->setHeaderOffset(1);

        $stmt = (new Statement())
            ->offset(1);

        $records = $stmt->process($csv);
        foreach ($records as $record) {
            DB::table('asx_company_details')->insert([
                'company_name' => $record['Company name'],
                'company_code' => $record['ASX code'],
                'gics_industry' => $record['GICS industry group'],
                'status' => 'pending'
            ]);
        }
    }
}
