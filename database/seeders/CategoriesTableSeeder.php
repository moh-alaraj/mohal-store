<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
           'name' => 'category 3',
           'slug' => Str::slug('category 3'),
            'description' => 'cat desc field',
            'parent_id'=> 1,

        ]);
    }
}
