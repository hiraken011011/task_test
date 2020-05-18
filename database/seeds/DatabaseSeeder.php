<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(HabitSeeder::class);
        $this->call(CateSeeder::class);
        $this->call(ColorSeeder::class);
    }
}
