<?php

use Illuminate\Database\Seeder;

class CateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cates')->insert([
            [
                'id' => 1,
                'cate_name' => '学習',
                'color_id' => 1,
                'created_at' => '2020-01-01 00:00:00',
            ],[
                'id' => 2,
                'cate_name' => '生活',
                'color_id' => 2,
                'created_at' => '2020-02-01 00:00:00',
            ],[
                'id' => 3,
                'cate_name' => 'その他',
                'color_id' => 3,
                'created_at' => '2020-03-01 00:00:00',
            ]
        ]);
    }
}
