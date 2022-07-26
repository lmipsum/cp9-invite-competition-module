<?php

namespace Tests\Browser;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ForgotPasswordTest extends DuskTestCase
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
    public function can_not_send_password_reset_email_to_invalid_email()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('password.request', [], false))
                ->type('input[name="email"]', 'random@email.com')
                ->press('Send Password Reset Link')
                ->assertSee(trans('passwords.user'));
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function can_send_password_reset_email()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('password.request', [], false))
                    ->type('input[name="email"]', $this->user->email)
                    ->press('Send Password Reset Link')
                    ->assertSee(trans('passwords.sent'));
        });
    }

    /**
     * @test
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function can_reset_its_password()
    {
        $token = Password::getRepository()->create($this->user);

        $this->browse(function (Browser $browser) use ($token) {
            $browser->visit(route('password.reset', $token, false))
                ->type('input[name="email"]', $this->user->email)
                ->type('input[name="password"]', 'secret99')
                ->type('input[name="password_confirmation"]', 'secret99')
                ->press('Reset Password')
                ->assertSee(trans('passwords.reset'));
        });
    }
}
