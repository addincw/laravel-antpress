<?php

namespace Tests\Unit\Http\controllers\Backsite\Site;

use App\User;
use App\Models\Site\Configuration;

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

        $response = $this->actingAs($user)->get('/backsite/site/configuration');

        $response->assertStatus(200);
    }
    public function testUpdateProfileFailed()
    {
        $user = User::where("email", "inidokterku@gmail.com")->first();
        $userProfile = Configuration::first();

        $this->actingAs($user)->post('/backsite/site/configuration', [
          'id' => $userProfile->id,
          'title' => $userProfile->title, //parameter no exist
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
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
        $userProfile = Configuration::first();

        $response = $this->actingAs($user)->post('/backsite/site/configuration', [
          'id' => $userProfile->id,
          'name' => $userProfile->title,
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
          'address' => 'Griyo mapan raya jaya no. 14',
          'email' => 'inidokterku@gmail.com',
          'facebook' => 'inidokterku@facebook.com',
          'twitter' => 'inidokterku@twitter.com',
          'instagram' => 'inidokterku@instagram.com',
          'youtube' => 'inidokterku@youtube.com',
        ]);

        $response
            ->assertRedirect('/backsite/site/configuration')
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
        $userProfile = Configuration::first();

        $response = $this->actingAs($user)->post('/backsite/site/configuration', [
          'id' => $userProfile->id,
          'name' => $userProfile->title,
          'description' => 'This is inidokterku website, website for sharing healty content',
          'phone' => '082232426655',
          'whatsapp' => '082232426655',
          'telegram' => '082232426655',
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
            ->assertRedirect('/backsite/site/configuration')
            ->assertSessionHas("status",[
                "code" => "success",
                "message" => "Kontak berhasil di perbarui"
            ]);
    }
}
