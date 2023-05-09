<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    /**
     * A basic feature test testing the image upload functionality from the proxy.
     *
     * @return void
     */
    public function test_upload_image_as_user()
    {
        $fakerImage = \Faker\Factory::create()->image(null, 640, 480, null, true, true, null, false, 'jpeg');
        $fakerText = \Faker\Factory::create()->text(100);
        File::put('/tmp/test.txt', $fakerText);
        shell_exec('steghide embed -cf ' . $fakerImage . ' -ef /tmp/test.txt -p password');
        $file = UploadedFile::fake()->image($fakerImage);
        $user = \App\Models\User::factory()->create();
        $user->generateApiKey();
        $this->assertNotNull($user->api_token);
        $response = $this->postJson('/api/images/' . $user->api_token, [
            'file' => $file,
        ]);
        $response->assertStatus(200);
    }
}
