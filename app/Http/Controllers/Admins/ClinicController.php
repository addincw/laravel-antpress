<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClinic;
use App\Models\Clinics\Clinic;

class ClinicController extends Controller
{
    private $route = 'admin/klinik';
    private $routeView = 'pages.admins.clinic';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Clinic();
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
      $this->params['clinics'] = $this->model->get();
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
    public function store(StoreClinic $request)
    {
      $validated = (object) $request->validated();
      $thumbnail = null;

      try {
        DB::beginTransaction();
        if ($request->hasFile('thumbnail')) {
          $thumbnail = $request->file('thumbnail')->store('clinic', 'public');
        }

        $clinic = $this->model->create([
          'title' => $validated->title,
          'slug' => str_replace(' ', '-', $validated->title) . '-' . rand(10,100),
          'description' => $validated->description,
          'thumbnail' => $thumbnail,
          'is_published' => $request->is_published === 'on' ? 1 : 0
        ]);

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Klinik berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('thumbnail')) {
          \Storage::disk('public')->delete($thumbnail);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan klinik : ' . $e->getMessage(),
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
      $this->params['clinic'] = $this->model->find($id);
      return view($this->routeView . '.show', $this->params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['clinic'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClinic $request, $id)
    {
      $validated = (object) $request->validated();
      $clinic = $this->model->where('id', $id)->first();
      $thumbnail = $clinic->thumbnail;

      try {
        DB::beginTransaction();
        if ($request->hasFile('thumbnail')) {
          if ($thumbnail) {
            \Storage::disk('public')->delete($clinic->thumbnail);
          }

          $thumbnail = $request->file('thumbnail')->store('clinic', 'public');
        }

        $clinic->update([
          'title' => $validated->title,
          'slug' => str_replace(' ', '-', $validated->title) . '-' . rand(10,100),
          'description' => $validated->description,
          'thumbnail' => $thumbnail,
          'is_published' => $request->is_published === 'on' ? 1 : 0,
        ]);

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'klinik berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('thumbnail')) {
          \Storage::disk('public')->delete($thumbnail);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui klinik : ' . $e->getMessage(),
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
      $clinic = $this->model->find($id);
      $name = $clinic->title;

      try {
        \Storage::disk('public')->delete($clinic->thumbnail);
        $clinic->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Klinik dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus klinik '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
