<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreLeave;

use App\Models\Doctor;
use App\Models\Leave;

class DoctorAbsentController extends Controller
{
    private $route = 'admin/ijin-dokter';
    private $routeView = 'pages.admins.doctor-absent';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Leave();
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
      $this->params['leaves'] = $this->model->get();
      return view($this->routeView . '.index', $this->params);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->params['doctors'] = Doctor::get();
        return view($this->routeView . '.create', $this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeave $request)
    {
      $validated = (object) $request->validated();
      
      try {
        $startDate = date('Y-m-d', strtotime($validated->start_date));
        $endDate = date('Y-m-d', strtotime($validated->end_date));

        $this->model->create([
          'doctor_id' => $validated->doctor_id,
          'start_date' => $startDate,
          'end_date' => $endDate,
          'content' => $request->content ? $request->content : ''
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Ijin Dokter berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Ijin Dokter : ' . $e->getMessage(),
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
        $this->params['doctors'] = Doctor::get();

        $this->params['leave'] = $this->model->find($id);

        $this->params['leave']->start_date = date('d F, Y', strtotime($this->params['leave']->start_date));
        $this->params['leave']->end_date = date('d F, Y', strtotime($this->params['leave']->end_date));

        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLeave $request, $id)
    {
      $validated = (object) $request->validated();
      $leave = $this->model->where('id', $id)->first();
      
      try {
        $startDate = date('Y-m-d', strtotime($validated->start_date));
        $endDate = date('Y-m-d', strtotime($validated->end_date));

        $leave->update([
          'doctor_id' => $validated->doctor_id,
          'start_date' => $startDate,
          'end_date' => $endDate,
          'content' => $request->content ? $request->content : ''
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Ijin Dokter berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui Ijin Dokter : ' . $e->getMessage(),
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
      $leave = $this->model->find($id);
      $name = $leave->name;

      try {
        $leave->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Ijin Dokter berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus Ijin Dokter : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
