<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AuthenticationTest extends DuskTestCase
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function setUp()
    {
        parent::setUp();
        $this->browse(function (Browser $browser) {
            $browser->logout();
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function unauthenticated_user_gets_redirected()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->assertRouteIs('login');
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function user_can_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login', [], false))
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs(route('pageTexts.edit', [], false));
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function user_can_not_login_with_invalid_details()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login', [], false))
                ->type('email', $this->user->email)
                ->type('password', str_random())
                ->press('Login')
                ->assertSee(trans('auth.failed'));
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function user_can_logout()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('pageTexts.edit', [], false))
                ->press('.dropdown-toggle')
                ->clickLink('Logout')
                ->assertPathIs(route('login', [], false));
        });
    }
}
