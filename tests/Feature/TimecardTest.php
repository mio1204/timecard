<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Timecard;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TimecardTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWorkTime()
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            'password' => Hash::make('test')
        ]);

        Timecard::factory()->create([
            'id' => 1,
            'date' => Carbon::today(),
            'work_start' => Carbon::parse('2021-04-30 10:00:00'),
            'work_finish' => Carbon::parse('2021-04-30 12:00:00'),
        ]);

        Rest::factory()->create([
            'id' => 1,
            'rest_start' => Carbon::parse('2021-04-30 11:00:00'),
            'rest_finish' => Carbon::parse('2021-04-30 11:30:00'),
        ]);

        $timecard = Timecard::where('id', 1)->first();
        $this->assertEquals('01:30:00', $timecard->getWorkTime());
    }

    public function testGetRestTime()
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            'password' => Hash::make('test')
        ]);

        Timecard::factory()->create([
            'id' => 1,
            'date' => Carbon::today(),
            'work_start' => Carbon::parse('2021-04-30 10:00:00'),
            'work_finish' => Carbon::parse('2021-04-30 12:00:00'),
        ]);
        Rest::factory()->create([
            'id' => 1,
            'rest_start' => Carbon::parse('2021-04-30 11:00:00'),
            'rest_finish' => Carbon::parse('2021-04-30 11:30:00'),
        ]);
        $timecard = Timecard::where('id', 1)->first();
        $this->assertEquals('00:30:00', $timecard->getRestTime());
    }

    public function testAccess()
    {
        // ログインせずトップページへアクセスするとログインへ
        $this->get('/')->assertRedirect('login');

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('logout');
        $response->assertRedirect('/login');

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }

    // ログイン成功
    public function valid_login()
    {
        $user = User::factory()->create([
            'password' => 'test1111'
        ]);
        $this->assertFalse(Auth::check());
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'test1111'
        ]);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/');
    }
    // ログイン失敗
    public function invalid_login()
    {
        $user = User::factory()->create([
            'password' => 'test1111'
        ]);
        $this->assertFalse(Auth::check());
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'test2222'
        ]);
        $this->assertFalse(Auth::check());
        $response->assertSessionHasErrors(['email']);
        $this->assertEquals(
            '登録情報がありません',
            session('errors')->first('email')
        );
    }

    public function testDatabase()
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            // 'password' => Hash::make('test'),
            'password' => 'test12345',
            'remember_token' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            'password' => 'test12345',
            'remember_token' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
