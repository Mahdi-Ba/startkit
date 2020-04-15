<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategoriesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) {
            DB::table('categories')->insert([
                'title' => $faker->text($maxNbChars = 10) ,
                'slug' => $faker->slug,
                'is_active' => mt_rand(0,1)
            ]);
        }
    }
}
