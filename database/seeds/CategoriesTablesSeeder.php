<?php

use Illuminate\Database\Seeder;

class CategoriesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\Category::class, 10)->create();
    }
}
