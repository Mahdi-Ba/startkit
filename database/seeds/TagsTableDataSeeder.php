<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Tags\Tag;

class TagsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker,Request $request)
    {

        for ($i=0; $i < 100; $i++) {
            $tag = Tag::create([
                'name' => $faker->text($maxNbChars = 6),
                'slug' => ["fa" =>"سلام"]

            ]);
        }
 /*       $request['name']= "{\"fa\": \"مهدی\"}";

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags',


        ]);
        dd($validator->fails());
        if ($validator->fails()) {

            return Response($validator->errors(), 400);
        }*/
/*  $tag = Tag::create([
            'name' => 'سامتی همه',
            'slug' => ["en" =>"edqwde"]

        ]);*/
/*        $collection = collect(['taylor', 'abigail', null])->map(function ($name) {
            return strtoupper($name);
        })->reject(function ($name) {
            return empty($name);
        });;
        dd($collection);*/
/*   $tag = Tag::findFromString("At.");
   dd($tag);*/
/*        $tah = Tag::all()->where('slug');
        dd($tah);*/


        /*
          $tag = Tag::create([
              'name' => $faker->text($maxNbChars = 6),
          ]);
          $tag->slug = ["fa"=>'  مهدی'];
          $tag->save();*/
/*
        $tag = Tag::containing('Modi')->get();
        dd($tag);*/


/*        $test = Tag::where('slug->fa','=', 'slam')->get();*/
/*        $test = Tag::where('slug','like', '%'.'qwde'.'%')->get();*/
   /*    $tag =  Tag::findOrCreate('علی');
       $tag->slug = ['fa' => 'سلوم'];
     $tag->fill(['slug'=>['slug' => 'سلامتی']]);
       $tag->save();*/
/*   $test = ['name' =>'علی']; */

/*      $test = Tag::find(36)->toArray();
      dd($test["slug"]);*/







    }
}
