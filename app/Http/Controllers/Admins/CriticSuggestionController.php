<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriticSuggestion;
use App\Models\CriticSuggestion;

class CriticSuggestionController extends Controller
{
    private $route = 'admin/kritik-saran';
    private $routeView = 'pages.admins.critic-suggestion';
    private $params = [];

    public function __construct ()
    {
      $this->model = new CriticSuggestion();
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
      $this->params['criticSuggestions'] = $this->model->get();
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
    public function store(StoreCriticSuggestion $request)
    {
      $validated = (object) $request->validated();

      try {

        $this->model->create([
          'name' => $validated->name,
          'email' => $validated->email,
          'critic_suggestion' => $validated->critic_suggestion
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'kritik dan saran berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan kritik dan saran : <br>' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect('/');
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
        $this->params['CriticSuggestion'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCriticSuggestion $request, $id)
    {
      $validated = (object) $request->validated();
      $criticSuggestion = $this->model->where('id', $id)->first();

      try {
        $criticSuggestion->update([
          'name' => $validated->name,
          'email' => $validated->email,
          'critic_suggestion' => $validated->critic_suggestion
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'kritik dan saran berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan kritik dan saran : <br>' . $e->getMessage(),
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
      $criticSuggestion = $this->model->find($id);
      $name = $criticSuggestion->name;

      try {
        $criticSuggestion->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'kritik dan saran dari <strong>'.$name.'</strong> berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus CriticSuggestion dari <strong>'.$name.'</strong> : <br>' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
