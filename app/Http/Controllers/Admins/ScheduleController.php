<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreSchedule;

use App\Models\Day;
use App\Models\Doctor;
use App\Models\Clinics\Clinic;
use App\Models\Clinics\ClinicDoctorSchedule as Schedule;

class ScheduleController extends Controller
{
    private $route = 'admin/jadwal-praktik';
    private $routeView = 'pages.admins.schedule';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Schedule();
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
      $this->params['schedules'] = $this->model->get();
      return view($this->routeView . '.index', $this->params);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->params['clinics'] = Clinic::get();
        $this->params['doctors'] = Doctor::get();
        $this->params['days'] = Day::get();
        return view($this->routeView . '.create', $this->params);
    }

    protected function parseTime ($val)
    {
        $time = [];

        //explode format ex: 12:00 AM
        $val = explode(" ", $val);
        // ex: AM / PM
        $desc = $val[1];        
        // explode format ex: 12:00
        $hourMinute = explode(":", $val[0]);

        $time['hour'] = $desc == 'AM' ? $hourMinute[0] : (int) $hourMinute[0] + 12;
        $time['minute'] = $hourMinute[1];

        return $time;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchedule $request)
    {
      $validated = (object) $request->validated();
      
      try {
        $startTime = $this->parseTime($validated->start_time);
        $endTime = $this->parseTime($validated->end_time);

        $this->model->create([
          'clinic_doctor_id' => $validated->doctor_id,
          'day_id' => $validated->day_id,
          'start_time' => $startTime['hour'] . ':' . $startTime['minute'],
          'end_time' => $endTime['hour'] . ':' . $endTime['minute'],
          'quota' => $validated->quota,
          'is_active' => $request->is_active == 'on' ? true : false
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Jadwal Praktik berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Jadwal Praktik : ' . $e->getMessage(),
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

    private function formatTime ($time)
    {
      // explode time menjadi hour, minute
      $time = explode(":", $time);
      $hour = $time[0];
      $minute = $time[1];
      // set to format AM / PM
      $desc = $hour < 12 ? 'AM' : 'PM';
      $hour = $hour <= 12 ? $hour : $hour - 12;

      return $hour . ':' . $minute . ' ' . $desc;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['clinics'] = Clinic::get();
        $this->params['doctors'] = Doctor::get();
        $this->params['days'] = Day::get();

        $this->params['schedule'] = $this->model->find($id);

        $this->params['schedule']->start_time = $this->formatTime($this->params['schedule']->start_time);
        $this->params['schedule']->end_time = $this->formatTime($this->params['schedule']->end_time);

        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSchedule $request, $id)
    {
      $validated = (object) $request->validated();
      $schedule = $this->model->where('id', $id)->first();
      
      try {
        $startTime = $this->parseTime($validated->start_time);
        $endTime = $this->parseTime($validated->end_time);

        $schedule->update([
          'clinic_doctor_id' => $validated->doctor_id,
          'day_id' => $validated->day_id,
          'start_time' => $startTime['hour'] . ':' . $startTime['minute'],
          'end_time' => $endTime['hour'] . ':' . $endTime['minute'],
          'quota' => $validated->quota,
          'is_active' => $request->is_active == 'on' ? true : false
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Jadwal Praktik berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui Jadwal Praktik : ' . $e->getMessage(),
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
      $schedule = $this->model->find($id);
      $name = $schedule->name;

      try {
        $schedule->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Jadwal Praktik berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus Jadwal Praktik : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
