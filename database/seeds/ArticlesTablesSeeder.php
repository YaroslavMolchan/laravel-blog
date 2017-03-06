<?php

use Illuminate\Database\Seeder;

class ArticlesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\Article::class, 20)
            ->create()
            ->each(function ($a) {
                $a->tags()->save(factory(App\Entities\Tag::class)->make());
            });
    }
}
