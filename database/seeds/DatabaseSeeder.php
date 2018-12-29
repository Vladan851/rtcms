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
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('posts')->truncate();
        // $this->call(UsersTableSeeder::class);
        
        factory(App\User::class, 10)->create();
        
        factory(App\Role::class, 3)->create();
        
        factory(App\Post::class, 10)->create();
    }
}
