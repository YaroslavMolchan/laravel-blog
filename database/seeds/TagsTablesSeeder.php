<?php

use Illuminate\Database\Seeder;

class TagsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\Tag::class, 10)->create();
    }
}
