<?php

namespace Tests;

use App\Page;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Page
     */
    protected $page;

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();

        // create user and log in with it
        $this->user = factory(\App\User::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
        });

        // create page with pageTexts and pageKeys
        $this->page = factory(Page::class)->create(['company_id' => $this->user->company_id]);
    }

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
