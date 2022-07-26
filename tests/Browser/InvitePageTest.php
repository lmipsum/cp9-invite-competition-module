<?php

namespace Tests\Browser;

use App\Page;
use App\PageSubmit;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class InvitePageTest extends DuskTestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        // create page with pageKeys
        $this->page = factory(Page::class)->create(['company_id' => $this->user->company_id]);

        $keys = [str_random(10), str_random(10), str_random(10)];
        $keys[] = "coming";
        foreach ($keys as $key) {
            factory(\App\PageKey::class)->create(['page_id' => $this->page->id, 'key' => $key]);
        }
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function can_submit_form()
    {
        $pageKeys = $this->page->pageKeys->where('key', '<>', 'coming');

        $formData = [];
        foreach ($pageKeys as $pageKey) {
            $formData[$pageKey->key] = str_random();
        }

        $this->browse(function (Browser $browser) use ($formData) {
            $browser->visit('/' . $this->page->hash)
                ->assertSee("Displaying page \"{$this->page->name}\"");
        });

        $this->browse(function (Browser $browser) use ($formData, $pageKeys) {
            $browser->visit('/' . $this->page->hash)
                ->check('#coming');

            foreach ($pageKeys as $pageKey) {
                $browser->assertSee($pageKey->name)
                    ->type("#{$pageKey->key}", $formData[$pageKey->key]);
            }

            $browser->screenshot('invite-form-before-submit');

            $browser->press('Submit')
                ->pause(2000)
                ->assertVue('submitted', true, '@invite');
        });

        $this->assertCount(1, $this->page->pageSubmits);

        /** @var PageSubmit $pageSubmit */
        $pageSubmit = $this->page->pageSubmits()->first();
        foreach ($pageKeys as $pageKey) {
            $this->assertEquals($formData[$pageKey->key], $pageSubmit->pageSubmitValues->where('key', $pageKey->key)->first()->value ?? null);
        }
    }
}
