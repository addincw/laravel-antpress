<?php

namespace App\Http\controllers\Backsite\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimoni;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    private $route = 'backsite/profile/testimoni';
    private $routeView = 'backsite.profiles.testimoni';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Testimoni();
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
      $this->params['testimonis'] = $this->model->get();
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
    public function store(StoreTestimoni $request)
    {
      $validated = (object) $request->validated();
      $thumbnail = null;

      try {
        if ($request->hasFile('thumbnail')) {
          $thumbnail = $request->file('thumbnail')->store('testimoni', 'public');
        }

        $this->model->create([
          'name' => $validated->name,
          'from' => $validated->from,
          'body' => $validated->description,
          'thumbnail' => $thumbnail
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Testimoni berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan testimoni : <br>' . $e->getMessage(),
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
        $this->params['testimoni'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTestimoni $request, $id)
    {
      $validated = (object) $request->validated();
      $testimoni = $this->model->where('id', $id)->first();
      $thumbnail = $testimoni->thumbnail;

      try {
        if ($request->hasFile('thumbnail')) {
          if ($thumbnail) {
            \Storage::disk('public')->delete($testimoni->thumbnail);
          }

          $thumbnail = $request->file('thumbnail')->store('testimoni', 'public');
        }

        $testimoni->update([
          'name' => $validated->name,
          'from' => $validated->from,
          'body' => $validated->description,
          'thumbnail' => $thumbnail
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Testimoni berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan testimoni : <br>' . $e->getMessage(),
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
      $testimoni = $this->model->find($id);
      $name = $testimoni->name;

      try {
        \Storage::disk('public')->delete($testimoni->thumbnail);
        $testimoni->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Testimoni dari <strong>'.$name.'</strong> berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus testimoni dari <strong>'.$name.'</strong> : <br>' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
