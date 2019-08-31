<?php

namespace App\Http\Controllers\Admins\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaq;
use App\Models\Faq;

class FaqController extends Controller
{
    private $route = 'admin/profile/faq';
    private $routeView = 'pages.admins.profiles.faq';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Faq();
      $this->params['route'] = $this->route;
      $this->params['routeView'] = $this->routeView;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->params['faqs'] = $this->model->get();
      return view($this->routeView . '.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view($this->routeView . '.create', $this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaq $request)
    {
      $validated = (object) $request->validated();

      try {

        $this->model->create([
          'question' => $validated->question,
          'answer' => $validated->answer,
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Faq berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Faq : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['faq'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaq $request, $id)
    {
      $validated = (object) $request->validated();
      $Faq = $this->model->where('id', $id)->first();

      try {

        $Faq->update([
          'question' => $validated->question,
          'answer' => $validated->answer
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Faq berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Faq : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $faq = $this->model->find($id);
      $name = $faq->name;

      try {
        $faq->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Faq dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus Faq dari '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
