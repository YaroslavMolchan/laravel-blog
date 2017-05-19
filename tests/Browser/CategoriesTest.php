<?php

namespace Tests\Browser;

use App\Entities\Article;
use App\Entities\Category;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoriesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group categories
     * @return void
     */
    public function testShow()
    {
        $category = factory(Category::class)->create();

        $this->browse(function (Browser $browser) use ($category) {
            $browser->visitRoute('categories.show', ['category' => $category->id])
                    ->assertRouteIs('categories.show', ['category' => $category->id]);
        });
    }
}
