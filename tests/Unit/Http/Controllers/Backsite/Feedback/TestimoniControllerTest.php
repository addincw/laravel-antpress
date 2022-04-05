<?php

namespace Tests\Unit\Http\Controllers\Backsite\Feedback;

use App\Models\Feedback\Testimoni;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TestimoniControllerTest extends TestCase
{
    private $baseRoute = "/backsite/feedback/testimoni";
    private $testimoniFields = [];

    private $arrStatusSuccess = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->testimoniFields = [
          'name' => 'user lcm',
          'from' => 'user@lcm',
          'description' => 'This is testimoni test body',
          'thumbnail' => '',
        ];

        $this->arrStatusSuccess = [
            "code" => "success",
            "message" => "Testimoni berhasil di tambahkan"
        ];

        $user = User::where("email", "administrator@lcm.com")->first();
        $this->actingAs($user);
    }

    protected function _mockData()
    {
        $testimoniFields = $this->testimoniFields;
        $testimoniFields['body'] = $testimoniFields['description'];

        unset($testimoniFields['description']);

        return Testimoni::create($testimoniFields);
    }

    /**
     *
     * @return void
     */
    public function testShowTestimoniIndex()
    {
        $response = $this->get($this->baseRoute);
        $response->assertStatus(200);
    }
    public function testShowFaqCreateForm()
    {
        $response = $this->get($this->baseRoute . '/create');
        $response->assertStatus(200);
    }
    public function testStoreTestimoniNotPassValidation()
    {
        $testimoniFields = $this->testimoniFields;

        unset($testimoniFields["name"]);

        $response = $this->post($this->baseRoute, $testimoniFields);

        $response->assertSessionHasErrors();
    }
    public function testStoreTestimoniWithoutImageSuccess()
    {
        $response = $this->post($this->baseRoute, $this->testimoniFields);

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $this->arrStatusSuccess);
    }
    public function testStoreTestimoniWithImageSuccess()
    {
        Storage::fake('public');
        $thumbnail = UploadedFile::fake()->image('user-testimoni.png');

        $testimoniFields = $this->testimoniFields;
        $testimoniFields['thumbnail'] = $thumbnail;

        $response = $this->post($this->baseRoute, $testimoniFields);

        Storage::disk('public')->assertExists('testimoni/' . $thumbnail->hashName());

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $this->arrStatusSuccess);
    }
    public function testShowTestimoniUpdateForm()
    {
        $testimoniFields = $this->testimoniFields;
        $testimoniFields['body'] = $testimoniFields['description'];

        unset($testimoniFields['description']);

        $testimoni = Testimoni::create($testimoniFields);

        $response = $this->get($this->baseRoute . '/' . $testimoni->id);
        $response->assertStatus(200);
    }
    public function testUpdateTestimoniNotPassValidation()
    {
        $testimoni = $this->_mockData();

        $testimoniFields = $this->testimoniFields;
        unset($testimoniFields['description']);

        $response = $this->put($this->baseRoute . '/' . $testimoni->id, $testimoniFields);
        $response->assertSessionHasErrors();
    }
    public function testUpdateTestimoniWithWrongId()
    {
        $this->put($this->baseRoute . '/999', $this->testimoniFields);  
        $this->assertEquals("danger", Session::get("status")["code"]);
    }
    public function testUpdateTestimoniWithoutImageSuccess()
    {
        $testimoni = $this->_mockData();

        $arrStatusSuccess = $this->arrStatusSuccess;
        $arrStatusSuccess["message"] = "Testimoni berhasil di perbarui";

        $response = $this->put($this->baseRoute . '/' . $testimoni->id, $this->testimoniFields);

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $arrStatusSuccess);
    }
    public function testUpdateTestimoniWithImageSuccess()
    {
        Storage::fake('public');
        $thumbnail = UploadedFile::fake()->image('user-testimoni.png');
        
        $testimoni = $this->_mockData();

        $testimoniFields = $this->testimoniFields;
        $testimoniFields['thumbnail'] = $thumbnail;

        $arrStatusSuccess = $this->arrStatusSuccess;
        $arrStatusSuccess["message"] = "Testimoni berhasil di perbarui";

        $response = $this->put($this->baseRoute . '/' . $testimoni->id, $testimoniFields);

        Storage::disk('public')->assertExists('testimoni/' . $thumbnail->hashName());

        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $arrStatusSuccess);
    }
    public function testDeleteTestimoniWithWrongId()
    {
        $this->delete($this->baseRoute . '/999', $this->testimoniFields);
        $this->assertEquals("danger", Session::get("status")["code"]);
    }
    public function testDeleteTestimoniSuccess()
    {
        $testimoni = $this->_mockData();

        $this->delete($this->baseRoute . '/' . $testimoni->id, $this->testimoniFields);
        $this->assertEquals("success", Session::get("status")["code"]);
    }
}
