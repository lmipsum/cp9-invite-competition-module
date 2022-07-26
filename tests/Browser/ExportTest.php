<?php

namespace Tests\Browser;

use App\Page;
use App\PageSubmit;
use App\PageSubmitValue;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExportTest extends DuskTestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        // create pageKeys and submits
        $keys = [str_random(10), str_random(10), str_random(10)];
        foreach ($keys as $key) {
            factory(\App\PageKey::class)->create(['page_id' => $this->page->id, 'key' => $key]);
        }

        factory(PageSubmit::class, 10)->create(['page_id' => $this->page->id])->each(function (PageSubmit $pageSubmit) {
            foreach ($this->page->pageKeys as $pageKey) {
                factory(PageSubmitValue::class)->create(['page_submit_id' => $pageSubmit->id, 'key' => $pageKey->key]);
            }
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function can_export_submits()
    {
        $filename = str_random();

        $this->browse(function (Browser $browser) use ($filename) {
            $browser->visit(route('pageSubmits.exportForm', [], false))
                ->assertSee("Exporting submits of page \"{$this->page->name}\"")
                ->assertSee("There are 10 submits to export.")
                ->type("input[name='filename']", $filename)
                ->screenshot('export-form-before-submit')
                ->press('Download');
        });
    }
}
