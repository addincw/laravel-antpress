<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Doctor;

class DoctorController extends Controller
{
    private $response = [
      'message' => '',
      'data' => null
    ];

    public function __construct ()
    {
        $this->model = new Doctor();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $doctors = $this->model->where('is_active', true)
                             ->paginate(10);

      $response = array_merge($this->response, $doctors->toArray());
      return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $doctor = $this->model->find($id);

        if (!$doctor) {
          $this->response['message'] = 'data tidak ditemukan';
          return response()->json($this->response, 404);
        }

        $this->response['data'] = $doctor;
      } catch (\Exception $e) {
        $this->response['message'] = 'terjadi kesalahan server';
        return response()->json($this->response, 500);
      }

      return response()->json($this->response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
