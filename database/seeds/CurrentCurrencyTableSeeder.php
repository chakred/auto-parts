<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CurrentCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('current_currency')->insert([
            'currency_name' => 'EUR',
            'rate' => 31,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('current_currency')->insert([
            'currency_name' => 'USD',
            'rate' => 28,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
