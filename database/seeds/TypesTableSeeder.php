<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
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
                'name' => '食器',
                'category' => 0,
            ],
            [
                'name' => '雑費',
                'category' => 0,
            ],
            [
                'name' => '給与',
                'category' => 1,
            ],
        ];

        foreach($params as $param) {
            DB::table('types')->insert($param);
        }
    }
}
