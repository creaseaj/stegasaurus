<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_can_generate_key()
    {
        // make a new user then assert  that a new api key has been generated after calling the command
        $user = User::factory()->create();
        $this->assertNull($user->api_token);
        $user->generateApiKey();
        $this->assertNotNull($user->api_token);
    }
}
