<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Session;
class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    // public function test_user_register()
    // {

    // }
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
        
        Session::start();
        $response = $this->call('POST', '/login', [
            'email' => $user->email,
            'password' => $password,
            '_token' => csrf_token()
        ]);

        // $response = $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => $password,
        // ]);
        // dd($user->email);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
