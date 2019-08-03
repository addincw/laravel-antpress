<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctor;
use App\Models\Doctor;

class DoctorController extends Controller
{
    private $route = 'admin/dokter';
    private $routeView = 'pages.admins.doctor';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Doctor();
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
      $this->params['doctors'] = $this->model->get();
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
    public function store(StoreDoctor $request)
    {
      // dd($request->all());
      $validated = (object) $request->validated();
      $image = null;

      try {
        if ($request->hasFile('image')) {
          $image = $request->file('image')->store('doctor', 'public');
        }

        $this->model->create([
          'name' => $validated->name,
          'specialist' => $validated->specialist,
          'gender' => $request->gender === 'on' ? 1 : 0,
          'image' => $image,
          'is_active' => $validated->is_active === 'on' ? 1 : 0
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Dokter berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan dokter : <br>' . $e->getMessage(),
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
        $this->params['doctor'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDoctor $request, $id)
    {
      $validated = (object) $request->validated();
      $doctor = $this->model->where('id', $id)->first();
      $image = $doctor->image;

      try {
        if ($request->hasFile('image')) {
          if ($image) {
            \Storage::disk('public')->delete($doctor->image);
          }

          $image = $request->file('image')->store('doctor', 'public');
        }

        $doctor->update([
          'name' => $validated->name,
          'specialist' => $validated->specialist,
          'gender' => $request->gender === 'on' ? 1 : 0,
          'image' => $image,
          'is_active' => $validated->is_active === 'on' ? 1 : 0
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Dokter berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan dokter : <br>' . $e->getMessage(),
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
      $doctor = $this->model->find($id);
      $name = $doctor->name;

      try {
        \Storage::disk('public')->delete($doctor->image);
        $doctor->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Dokter <strong>'.$name.'</strong> berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus dokter <strong>'.$name.'</strong> : <br>' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
