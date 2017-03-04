<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTablesSeeder::class);
        $this->call(TagsTablesSeeder::class);
        $this->call(ArticlesTablesSeeder::class);
    }
}
