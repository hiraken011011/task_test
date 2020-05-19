<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'テストユーザー1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password1'),
            ],[
                'name' => 'テストユーザー2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password2'),
            ],[
                'name' => 'テストユーザー3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password3'),
            ]
        ]);
    }
}
