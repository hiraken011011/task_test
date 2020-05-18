<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'name' => '15分の自習を4回',
                'deadline' => '2019-01-01 00:00:00',
                'status' => '0',
                'habit_id' => 1,
                'cate_id' => 1,
                'created_at' => '2019-01-01 00:00:00',
                'updated_at' => '2019-01-01 00:00:00',
            ],[
                'id' => 2,
                'name' => '近所の川でランニング',
                'deadline' => '2019-02-01 00:00:00',
                'status' => '0',
                'habit_id' => 2,
                'cate_id' => 2,
                'created_at' => '2019-02-02 00:00:00',
                'updated_at' => '2019-02-02 00:00:00',
            ],[
                'id' => 3,
                'name' => '明日の準備',
                'deadline' => '2019-03-01 00:00:00',
                'status' => '1',
                'habit_id' => 3,
                'cate_id' => 3,
                'created_at' => '2019-03-03 00:00:00',
                'updated_at' => '2019-03-03 00:00:00',
            ]
        ]);
    }
}
