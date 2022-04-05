<?php

namespace Tests\Unit\Http\Controllers\Backsite\Site;

use App\User;
use App\Models\Site\Configuration;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class ConfigurationControllerTest extends TestCase
{
    private $baseRoute = "/backsite/site/configuration";
    private $siteConfigurationFields = [];

    private $arrStatusSuccess = [];

    protected function setUp(): void
    {
        parent::setUp();

        $siteConfiguration = Configuration::first();

        $this->siteConfigurationFields = [
          'id' => $siteConfiguration->id,
          'name' => $siteConfiguration->title,
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
        ];

        $this->arrStatusSuccess = [
            "code" => "success",
            "message" => "Kontak berhasil di perbarui"
        ];

        $user = User::where("email", "administrator@lcm.com")->first();
        $this->actingAs($user);
    }
    /**
     *
     * @return void
     */
    public function testShowConfigurationIndex()
    {
        $response = $this->get($this->baseRoute);
        $response->assertStatus(200);
    }
    public function testUpdateConfigurationFailed()
    {
        $siteConfigurationFields = $this->siteConfigurationFields;

        // set random key to test is function still working
        $siteConfigurationFields["title"] = $siteConfigurationFields['name'];
        unset($siteConfigurationFields['name']);

        $this->post($this->baseRoute, $siteConfigurationFields);

        $this->assertEquals("warning", Session::get("status")["code"]);
    }
    public function testUpdateConfigurationWithoutImageSuccess()
    {
        $response = $this->post($this->baseRoute, $this->siteConfigurationFields);

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $this->arrStatusSuccess);
    }
    public function testUpdateConfigurationWithImageSuccess()
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('logo.png');
        $logoFull = UploadedFile::fake()->image('logo_full.png');

        $siteConfigurationFields = $this->siteConfigurationFields;
        $siteConfigurationFields['logo'] = $logo;
        $siteConfigurationFields['logo_full'] = $logoFull;

        $response = $this->post($this->baseRoute, $siteConfigurationFields);

        // Assert the file was stored...
        Storage::disk('public')->assertExists('site/' . $logo->hashName());
        Storage::disk('public')->assertExists('site/' . $logoFull->hashName());

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $this->arrStatusSuccess);
    }
}
