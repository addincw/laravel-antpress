<?php $schedule = !empty($schedule) ? $schedule : NUll; ?>
<div class="form-body">
  <div class="form-group">
    <label>Klinik</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <span class="ft-plus-square"></span>
        </span>
      </div>
      <select class="form-control" name="clinic_id" data-placeholder="Pilih Klinik" width="100%">
        <option value=""></option>
        @foreach($clinics as $clinic)
        <option value="{{ $clinic->id }}" @if($schedule && $schedule->clinic_doctor->clinic_id === $clinic->id) selected @endif>{{ $clinic->title }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label>Dokter</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <span class="ft-user-plus"></span>
        </span>
      </div>
      <select class="form-control" name="doctor_id" data-placeholder="Pilih Dokter" width="100%">
        <option value=""></option>
        @foreach($doctors as $doctor)
        <option value="{{ $doctor->id }}" @if($schedule && $schedule->clinic_doctor->doctor_id === $doctor->id) selected @endif>{{ $doctor->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label>Hari</label>
    <select class="form-control" name="day_id" data-placeholder="Pilih Hari">
      <option value=""></option>
      @foreach($days as $day)
      <option value="{{ $day->id }}" @if($schedule && $schedule->day_id === $day->id) selected @endif>{{ $day->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Jam Mulai</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <span class="ft-clock"></span>
            </span>
          </div>
          <input type='text' class="form-control pickatime" placeholder="Jam Mulai" name="start_time" @if(!empty($schedule)) value="{{ $schedule->start_time }}" @endif />
        </div>
        <small class="text-muted">Isi jam mulai pendaftaran.
        </small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Jam Akhir</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <span class="ft-clock"></span>
            </span>
          </div>
          <input type='text' class="form-control pickatime" placeholder="Jam Akhir" name="end_time" @if(!empty($schedule)) value="{{ $schedule->end_time }}" @endif />
        </div>
        <small class="text-muted">Isi jam akhir pendaftaran.
        </small>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Kuota Pasien</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <span class="ft-users"></span>
        </span>
      </div>
      <input type='text' class="form-control" placeholder="Kuota" name="quota" @if(!empty($schedule)) value="{{ $schedule->quota }}" @endif />
    </div>
    <small class="text-muted">Kuota pasien yang dapat di layani
    </small>
  </div>
  <div class="form-group">
    <div class="float-right">
      <span class="isActiveVal mr-2">
        @if(empty($schedule) || $schedule->is_active)
          Aktif
        @else
          Tidak Aktif
        @endif
      </span>
      <input type="checkbox" name="is_active" id="isActive" class="switchery" data-size="sm" @if(empty($schedule) || $schedule->is_active) checked @endif/>
    </div>
    <label for="is_active" class="font-medium-1">Status Jadwal</label>
  </div>
</div>

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/plugins/pickers/daterange/daterange.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
// Switchery
var i = 0;
if (Array.prototype.forEach) {
    var elems = $('.switchery');
    $.each( elems, function( key, value ) {
        var $size="", $color="",$sizeClass="", $colorCode="";
        $size = $(this).data('size');
        var $sizes ={
            'lg' : "large",
            'sm' : "small",
            'xs' : "xsmall"
        };
        if($(this).data('size')!== undefined){
            $sizeClass = "switchery switchery-"+$sizes[$size];
        }
        else{
            $sizeClass = "switchery";
        }

        $color = $(this).data('color');
        var $colors ={
            'primary' : "#967ADC",
            'success' : "#37BC9B",
            'danger' : "#DA4453",
            'warning' : "#F6BB42",
            'info' : "#3BAFDA"
        };
        if($color !== undefined){
            $colorCode = $colors[$color];
        }
        else{
            $colorCode = "#37BC9B";
        }

        var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode });
    });
} else {
    var elems1 = document.querySelectorAll('.switchery');

    for (i = 0; i < elems1.length; i++) {
        var $size = elems1[i].data('size');
        var $color = elems1[i].data('color');
        var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
    }
}

$('select').select2();
$('select[name="clinic_id"]').on('select2:select', function (e) {
    var data = e.params.data;
    var url = "{{ url('/') }}" + `/api/clinic/${data.id}/doctors`;

    $('select[name="doctor_id"]').select2({ 
      ajax: {
        url: url,
        processResults: function (data) {
          return { results: data.data };
        }
      }
    });
});

$('.pickatime').pickatime();

$(".switchery").change(function () {
  $(this).is(':checked') ?
    $(".isActiveVal").html('Aktif') : $(".isActiveVal").html('Tidak Aktif')  
})
</script>
@endsection