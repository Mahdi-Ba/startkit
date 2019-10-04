<?php

use Illuminate\Database\Seeder;

class MenuSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $node = App\Menu::create([
            'id' =>15,
            'title' => 'Foo',
            'slug' => 'Foo',
            'children' => [
                [
                    'title' => 'Bar',
                    'slug' => 'Bar',
                    'children' => [
                        [
                            'title' => 'Baz',
                            'slug' => 'Baz'
                        ],
                        [
                            'title' => 'Baz1',
                            'slug' => 'Baz1'
                        ],
                    ],
                ],
            ],
        ]);
    }
}
