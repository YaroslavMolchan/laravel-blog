<?php

namespace Tests\Browser;

use App\Entities\Article;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

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

    /**
     * @group articles
     * @author MY
     */
    public function testSearch()
    {
        factory(Article::class, 20)->create();

        $query = 'ipsan';

        $this->browse(function (Browser $browser) use ($query) {
            $browser->visit('/')
                ->type('query', $query)
                ->press('Search')
                ->assertQueryStringHas('query', $query);
        });
    }

    /**
     * @group articles
     * @author MY
     */
    public function testLeaveComment()
    {
        $article = factory(Article::class)->create();

        $faker = Factory::create();

        $this->browse(function (Browser $browser) use ($article, $faker) {
            $comment = $faker->text;

            $browser->visitRoute('articles.show', ['id' => $article->id, 'slug' => $article->alias])
                ->assertSee($article->title)
                ->type('name', $faker->firstName)
                ->type('email', $faker->safeEmail)
                ->type('comment', $comment)
                ->press('Отправить')
                ->assertSee($comment);
        });
    }

    /**
     * @group articles
     * @author MY
     */
    public function testLeaveReply()
    {
        $article = factory(Article::class)->create();

        $faker = Factory::create();

        $this->browse(function (Browser $browser) use ($article, $faker) {
            $comment = $faker->text;
            $replyComment = $faker->text;

            $browser->visitRoute('articles.show', ['id' => $article->id, 'slug' => $article->alias])
                ->assertSee($article->title)
                ->type('name', $faker->firstName)
                ->type('email', $faker->safeEmail)
                ->type('comment', $comment)
                ->press('Отправить')
                ->assertSee($comment)
                ->clickLink('Reply')
                ->pause(1000)
                ->type('name', $faker->firstName)
                ->type('email', $faker->safeEmail)
                ->type('comment', $replyComment)
                ->press('Отправить')
                ->assertSee($replyComment);
        });
    }
}
