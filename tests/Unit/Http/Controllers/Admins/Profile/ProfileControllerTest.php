<?php

namespace Tests\Unit\Http\Controllers\Admins\Profile;

use App\User;
use App\Models\Profile;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class ProfileControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testShowProfileIndex()
    {
        $user = User::where("email", "inidokterku@gmail.com")->first();

        $response = $this->actingAs($user)->get('/admin/profile/profile');

        $response->assertStatus(200);
    }
    public function testUpdateProfileFailed()
    {
        $user = User::where("email", "inidokterku@gmail.com")->first();
        $userProfile = Profile::first();

        $this->actingAs($user)->post('/admin/profile/profile', [
          'id' => $userProfile->id,
          'title' => $userProfile->title, //parameter no exist
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
          'emergency_call' => '14043',
          'address' => 'Griyo mapan raya jaya no. 14',
          'email' => 'inidokterku@gmail.com',
          'facebook' => 'inidokterku@facebook.com',
          'twitter' => 'inidokterku@twitter.com',
          'instagram' => 'inidokterku@instagram.com',
          'youtube' => 'inidokterku@youtube.com',
        ]);

        $this->assertEquals("warning", Session::get("status")["code"]);
    }
    public function testUpdateProfileWithoutImageSuccess()
    {
        $user = User::where("email", "inidokterku@gmail.com")->first();
        $userProfile = Profile::first();

        $response = $this->actingAs($user)->post('/admin/profile/profile', [
          'id' => $userProfile->id,
          'name' => $userProfile->title,
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
          'emergency_call' => '14043',
          'address' => 'Griyo mapan raya jaya no. 14',
          'email' => 'inidokterku@gmail.com',
          'facebook' => 'inidokterku@facebook.com',
          'twitter' => 'inidokterku@twitter.com',
          'instagram' => 'inidokterku@instagram.com',
          'youtube' => 'inidokterku@youtube.com',
        ]);

        $response
            ->assertRedirect('/admin/profile/profile')
            ->assertSessionHas("status",[
                "code" => "success",
                "message" => "Kontak berhasil di perbarui"
            ]);
    }
    public function testUpdateProfileWithImageSuccess()
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('logo.png');
        $logoFull = UploadedFile::fake()->image('logo_full.png');

        $user = User::where("email", "inidokterku@gmail.com")->first();
        $userProfile = Profile::first();

        $response = $this->actingAs($user)->post('/admin/profile/profile', [
          'id' => $userProfile->id,
          'name' => $userProfile->title,
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
          'emergency_call' => '14043',
          'address' => 'Griyo mapan raya jaya no. 14',
          'email' => 'inidokterku@gmail.com',
          'facebook' => 'inidokterku@facebook.com',
          'twitter' => 'inidokterku@twitter.com',
          'instagram' => 'inidokterku@instagram.com',
          'youtube' => 'inidokterku@youtube.com',
          'logo' => $logo,
          'logo_full' => $logoFull
        ]);

        // Assert the file was stored...
        Storage::disk('public')->assertExists('profile/' . $logo->hashName());
        Storage::disk('public')->assertExists('profile/' . $logoFull->hashName());

        $response
            ->assertRedirect('/admin/profile/profile')
            ->assertSessionHas("status",[
                "code" => "success",
                "message" => "Kontak berhasil di perbarui"
            ]);
    }
}
