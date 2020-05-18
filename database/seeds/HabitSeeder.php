<?php

use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('habits')->insert([
            [
                'id' => 1,
                'habit_name' => '朝起きた後',
                'created_at' => '2020-01-01 00:00:00',
            ],[
                'id' => 2,
                'habit_name' => '晩ご飯食べた後',
                'created_at' => '2020-02-01 00:00:00',
            ],[
                'id' => 3,
                'habit_name' => 'お風呂入った後',
                'created_at' => '2020-03-01 00:00:00',
            ]
        ]);
    }
}
