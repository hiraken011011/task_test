<?php

use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('colors')->insert([
            [
                'id' => 1,
                'color_code' => '#ED1042',
                'color_name' => 'レッド',
            ],[
                'id' => 2,
                'color_code' => '#1042ED',
                'color_name' => 'ブルー',
            ],[
                'id' => 3,
                'color_code' => '#5BD920',
                'color_name' => 'グリーン',
            ],[
                'id' => 4,
                'color_code' => '#f0b942',
                'color_name' => 'オレンジ',
            ],[
                'id' => 5,
                'color_code' => '#d920b8',
                'color_name' => 'ピンク',
            ],[
                'id' => 6,
                'color_code' => '#9e20d9',
                'color_name' => 'パープル',
            ],[
                'id' => 7,
                'color_code' => '#9e9e9e',
                'color_name' => 'グレー'
            ]
        ]);
    }
}
