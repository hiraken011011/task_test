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
                'name' => "15分の自習を4回",
                'deadline' => '2020-01-01 07:00:00',
                'status' => '0',
                'habit_id' => 1,
                'cate_id' => 1,
                'created_at' => '2020-05-01 00:00:00',
                'updated_at' => '2020-05-01 00:00:00',
            ],[
                'id' => 2,
                'name' => "近所の川でランニング",
                'deadline' => '2020-02-01 08:15:00',
                'status' => '0',
                'habit_id' => 2,
                'cate_id' => 2,
                'created_at' => '2020-05-02 00:00:00',
                'updated_at' => '2020-05-02 00:00:00',
            ],[
                'id' => 3,
                'name' => "明日の準備",
                'deadline' => '2020-03-01 21:30:00',
                'status' => '1',
                'habit_id' => 7,
                'cate_id' => 7,
                'created_at' => '2020-05-03 00:00:00',
                'updated_at' => '2020-05-03 00:00:00',
            ],[
                'id' => 4,
                'name' => "本30ページ読み進める",
                'deadline' => '2020-03-19 20:00:00',
                'status' => '1',
                'habit_id' => 6,
                'cate_id' => 5,
                'created_at' => '2020-05-04 00:00:00',
                'updated_at' => '2020-05-04 00:00:00',
            ],[
                'id' => 5,
                'name' => "映画1本見る",
                'deadline' => '2020-03-15 16:00:00',
                'status' => '0',
                'habit_id' => 5,
                'cate_id' => 3,
                'created_at' => '2020-05-05 00:00:00',
                'updated_at' => '2020-05-05 00:00:00',
            ],[
                'id' => 6,
                'name' => "Udemyでセクション1つクリアする",
                'deadline' => '2020-05-24 9:45:00',
                'status' => '0',
                'habit_id' => 3,
                'cate_id' => 1,
                'created_at' => '2020-05-06 00:00:00',
                'updated_at' => '2020-05-06 00:00:00',
            ],[
                'id' => 7,
                'name' => "ToDoリスのデバッグ作業",
                'deadline' => '2020-05-18 12:30:00',
                'status' => '1',
                'habit_id' => 4,
                'cate_id' => 4,
                'created_at' => '2020-05-07 00:00:00',
                'updated_at' => '2020-05-07 00:00:00'
            ]
        ]);
    }
}
