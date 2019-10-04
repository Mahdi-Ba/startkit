<?php

use App\User;
use Illuminate\Database\Seeder;


class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@admin.com'),
            ]);

    }
}
