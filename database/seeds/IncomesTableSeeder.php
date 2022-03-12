<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IncomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'amount' => 10000,
                'date' => '2021-12-31',
                'comment' => 'サンプル1',
                'type_id' => 3,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'amount' => 50000,
                'date' => '2021-01-01',
                'comment' => 'サンプル2',
                'type_id' => 3,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'amount' => 100000,
                'date' => '2021-02-01',
                'comment' => 'サンプル3',
                'type_id' => 3,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
        ];

        foreach($params as $param) {
            DB::table('incomes')->insert($param);
        }
    }
}
