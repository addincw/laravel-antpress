<?php

namespace App\Http\Controllers\Admins\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Registrations\StoreDebitur;

use App\Models\Registrations\Debitur;

class DebiturController extends Controller
{
    private $route = 'admin/registration/debitur';
    private $routeView = 'pages.admins.registrations.debitur';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Debitur();
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
      $this->params['debiturs'] = $this->model->get();
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
    public function store(StoreDebitur $request)
    {
      $validated = (object) $request->validated();

      try {

        $this->model->create([
          'name' => $validated->name,
          'description' => $request->description,
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Debitur berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Debitur : ' . $e->getMessage(),
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
        $this->params['debitur'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDebitur $request, $id)
    {
      $validated = (object) $request->validated();
      $debitur = $this->model->where('id', $id)->first();

      try {

        $debitur->update([
          'name' => $validated->name,
          'description' => $request->description
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Debitur berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Debitur : ' . $e->getMessage(),
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
      $debitur = $this->model->find($id);
      $name = $debitur->name;

      try {
        $debitur->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'debitur dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus debitur dari '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
