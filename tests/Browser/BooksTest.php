<?php

namespace Tests\Browser;

use App\Entities\Book;
use App\Entities\BookAuthor;
use App\Entities\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BooksTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group books
     * @return void
     */
    public function testIndex()
    {
        factory(Book::class, 20)
            ->create()
            ->each(function ($b) {
                $b->authors()->save(factory(BookAuthor::class)->make());
            });

        $this->browse(function (Browser $browser) {
            $browser->visitRoute('books.index')
                    ->assertRouteIs('books.index')
                    ->assertSee('Список прочитанных книг');
        });
    }

    /**
     * @group books
     * @author MY
     */
    public function testShow()
    {
        $book = factory(Book::class)
                ->create()
                ->each(function ($b) {
                    $b->authors()->save(factory(BookAuthor::class)->make());
                });

        $this->browse(function (Browser $browser) use ($book) {
            $browser->visitRoute('books.show', ['id' => $book->id])
                ->assertSee($book->title);
        });
    }
//
//    public function testCreate()
//    {
//
//    }
}
