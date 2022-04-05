<?php

namespace Tests\Unit\Http\Controllers\Backsite\Site;

use App\Models\Site\Faq;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class FaqControllerTest extends TestCase
{    
    private $baseRoute = "/backsite/site/faq";
    private $faqFields = [];

    private $arrStatusSuccess = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->faqFields = [
            "question" => "This is test question",
            "answer" => "This is test answer"
        ];

        $this->arrStatusSuccess = [
            "code" => "success",
            "message" => "Faq berhasil di tambahkan"
        ];

        $user = User::where("email", "administrator@lcm.com")->first();
        $this->actingAs($user);
    }
    /**
     *
     * @return void
     */
    public function testShowFaqIndex()
    {
        $response = $this->get($this->baseRoute);
        $response->assertStatus(200);
    }
    public function testShowFaqCreateForm()
    {
        $response = $this->get($this->baseRoute . '/create');
        $response->assertStatus(200);
    }
    public function testStoreFaqNotPassValidation()
    {
        $faqFields = $this->faqFields;

        unset($faqFields["question"]);

        $response = $this->post($this->baseRoute, $faqFields);

        $response->assertSessionHasErrors();
    }
    public function testStoreFaqSuccess()
    {
        $response = $this->post($this->baseRoute, $this->faqFields);
        
        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $this->arrStatusSuccess);
    }
    public function testShowFaqUpdateForm()
    {
        $faq = Faq::create($this->faqFields);

        $response = $this->get($this->baseRoute . '/' . $faq->id);
        $response->assertStatus(200);
    }
    public function testUpdateFaqNotPassValidation()
    {
        $faq = Faq::create($this->faqFields);
        $faqFields = $this->faqFields;

        unset($faqFields["question"]);

        $response = $this->put($this->baseRoute . '/' . $faq->id, $faqFields);
        $response->assertSessionHasErrors();
    }
    public function testUpdateFaqWithWrongId()
    {
        $this->put($this->baseRoute . '/999', $this->faqFields);       
        $this->assertEquals("danger", Session::get("status")["code"]);
    }
    public function testUpdateFaqSuccess()
    {
        $faq = Faq::create($this->faqFields);

        $response = $this->put($this->baseRoute . '/' . $faq->id, $this->faqFields);

        $arrStatusSuccess =$this->arrStatusSuccess;
        $arrStatusSuccess["message"] = "Faq berhasil di perbarui";
        
        $response
            ->assertRedirect($this->baseRoute)
            ->assertSessionHas("status", $arrStatusSuccess);
    }
    public function testDeleteFaqWithWrongId()
    {
        $this->delete($this->baseRoute . '/999', $this->faqFields);
        $this->assertEquals("danger", Session::get("status")["code"]);
    }
    public function testDeleteFaqSuccess()
    {
        $faq = Faq::create($this->faqFields);

        $this->delete($this->baseRoute . '/' . $faq->id, $this->faqFields);
        $this->assertEquals("success", Session::get("status")["code"]);
    }
}
