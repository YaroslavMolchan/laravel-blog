<?php

namespace Tests\Browser;

use App\Entities\Article;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group articles
     * @return void
     */
    public function testIndex()
    {
        factory(Article::class, 20)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('2')
                    ->assertQueryStringHas('page', 2);
        });
    }

    /**
     * @group articles
     * @author MY
     */
    public function testShow()
    {
        $article = factory(Article::class)->create();

        $this->browse(function (Browser $browser) use ($article) {
            $browser->visitRoute('articles.show', ['id' => $article->id, 'slug' => $article->alias])
                ->assertSee($article->title);
        });
    }
}
