<?php

namespace Tests\Browser;

use App\Entities\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TagsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group tags
     * @return void
     */
    public function testShow()
    {
        $tag = factory(Tag::class)->create();

        $this->browse(function (Browser $browser) use ($tag) {
            $browser->visitRoute('tags.show', ['tag' => $tag->id])
                    ->assertRouteIs('tags.show', ['tag' => $tag->id]);
        });
    }
}
