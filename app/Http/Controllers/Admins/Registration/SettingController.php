<?php

namespace App\Http\Controllers\Admins\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Registrations\StoreSetting;

use App\Models\Registrations\Debitur;
use App\Models\Registrations\RegistrationSetting;

class SettingController extends Controller
{
    private $route = 'admin/registration/setting';
    private $routeView = 'pages.admins.registrations.setting';
    private $params = [];

    public function __construct ()
    {
      $this->model = new RegistrationSetting();
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
      $this->params['settings'] = $this->model->get();
      $activeSetting = $this->model->where('start_date', '<=', date('Y-m-d'))->orderBy('start_date', 'desc')->first();

      if(!empty($activeSetting))
        $this->params['activeSetting'] = $activeSetting->start_date;

      return view($this->routeView . '.index', $this->params);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->params['debiturs'] = Debitur::get();
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
    public function store(StoreSetting $request)
    {
      $validated = (object) $request->validated();
      
      try {
        $startTime = $this->parseTime($validated->start_time);
        $endTime = $this->parseTime($validated->end_time);

        $start_date = date('Y-m-d', strtotime($validated->start_date));
        
        $byClinic = $request->registration_by == 'on' ? true : false;
        $byDoctor = $request->registration_by == 'on' ? false : true;

        $this->model->create([
          'hour_start' => $startTime['hour'],
          'minutes_start' => $startTime['minute'],
          'hour_end' => $endTime['hour'],
          'minutes_end' => $endTime['minute'],
          'by_clinic' => $byClinic,
          'by_doctor' => $byDoctor,
          'start_date' => $start_date,
          'debitur_id' => $validated->debitur_id
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Setting berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan Setting : ' . $e->getMessage(),
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

    private function formatTime ($hour, $minute)
    {
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
        $this->params['debiturs'] = Debitur::get();
        $this->params['setting'] = $this->model->find($id);

        $this->params['setting']->start_time = $this->formatTime($this->params['setting']->hour_start, $this->params['setting']->minutes_start);
        $this->params['setting']->end_time = $this->formatTime($this->params['setting']->hour_end, $this->params['setting']->minutes_end);

        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSetting $request, $id)
    {
      $validated = (object) $request->validated();
      $setting = $this->model->where('id', $id)->first();
      
      try {
        $startTime = $this->parseTime($validated->start_time);
        $endTime = $this->parseTime($validated->end_time);

        $start_date = date('Y-m-d', strtotime($validated->start_date));
        
        $byClinic = $request->registration_by == 'on' ? true : false;
        $byDoctor = $request->registration_by == 'on' ? false : true;

        $setting->update([
          'hour_start' => $startTime['hour'],
          'minutes_start' => $startTime['minute'],
          'hour_end' => $endTime['hour'],
          'minutes_end' => $endTime['minute'],
          'by_clinic' => $byClinic,
          'by_doctor' => $byDoctor,
          'start_date' => $start_date,
          'debitur_id' => $validated->debitur_id
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Setting berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui Setting : ' . $e->getMessage(),
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
      $setting = $this->model->find($id);
      $name = $setting->name;

      try {
        $setting->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Setting dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus Setting dari '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
