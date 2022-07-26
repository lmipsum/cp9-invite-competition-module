<?php

namespace Tests\Browser;

use App\Page;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PageTextEditTest extends DuskTestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        // create pageTexts
        $keys = [str_random(10), str_random(10), str_random(10)];
        foreach ($keys as $key) {
            factory(\App\PageText::class)->create(['page_id' => $this->page->id, 'key' => $key]);
        }
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function can_update_texts()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('pageTexts.edit', [], false))
                    ->assertSee("Editing text contents of page \"{$this->page->name}\"");

            foreach ($this->page->pageTexts as $i => $pageText) {
                $browser->assertSee($pageText->name);
                $browser->type("#pageTexts$i", 'newValue');
            }

            $browser->screenshot('page-texts-form-before-submit');

            $browser->press('Save')
                ->assertSee('Changes successfully saved.');
        });

        foreach ($this->page->fresh('pageTexts')->pageTexts as $pageText) {
            $this->assertEquals('newValue', $pageText->value);
        }
    }
}
