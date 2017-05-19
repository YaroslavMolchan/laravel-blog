<?php

namespace Tests\Browser;

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
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('books.index')
                    ->assertRouteIs('books.index')
                    ->assertSee('Список прочитанных книг');
        });
    }
}
