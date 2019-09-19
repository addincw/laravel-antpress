<?php $setting = !empty($setting) ? $setting : NUll; ?>
<div class="form-body">
  <div class="form-group">
    <label>Hari Mulai Pendaftaran</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <span class="ft-sun"></span>
        </span>
      </div>
      <select class="form-control" name="before_dday" width="100%" data-placeholder="Pilih hari mulai pendaftaran">
        <option></option>
        @for($day=1; $day <=30; $day++)
        <option value="{{ $day }}" @if(!empty($setting) && $setting->before_dday == $day) selected @endif>h - {{ $day }}</option>
        @endfor
      </select>
    </div>
    <small class="text-muted">Dihitung sebelum hari - h.
    </small>
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
          <input type='text' class="form-control pickatime" placeholder="Jam Mulai" name="start_time" @if(!empty($setting)) value="{{ $setting->start_time }}" @endif />
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
          <input type='text' class="form-control pickatime" placeholder="Jam Akhir" name="end_time" @if(!empty($setting)) value="{{ $setting->end_time }}" @endif />
        </div>
        <small class="text-muted">Isi jam akhir pendaftaran.
        </small>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="float-right">
      <span class="registrationByVal mr-2">
        @if(empty($setting) || $setting->by_clinic)
          Klinik
        @else
          Dokter
        @endif
      </span>
      <input type="checkbox" name="registration_by" id="registrationBy" class="switchery" data-size="sm" @if(empty($setting) || $setting->by_clinic) checked @endif/>
    </div>
    <label for="registration_by" class="font-medium-1">Registrasi berdasarkan</label>
  </div>
  <div class="form-group">
    <div class="form-group">
      <label>Tanggal Berlaku</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <span class="la la-calendar-o"></span>
          </span>
        </div>
        <input type='text' class="form-control pickadate" placeholder="Tanggal berlaku setting" name="start_date" @if(!empty($setting)) value="{{ date('d F, Y', strtotime($setting->start_date)) }}" @endif />
      </div>
      <small class="text-muted">Tanggal berlaku setting di berlakukan.
      </small>
    </div>
  </div>
  <div class="form-group">
    <label>Debitur</label>
    <select class="form-control" name="debitur_id" data-placeholder="Pilih debitur pendaftaran">
      <option value=""></option>
      @foreach($debiturs as $debitur)
      <option value="{{ $debitur->id }}" @if($setting && $setting->debitur_id === $debitur->id) selected @endif>{{ $debitur->name }}</option>
      @endforeach
    </select>
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

$('.pickadate').pickadate();

$('.pickatime').pickatime();

$(".switchery").change(function () {
  $(this).is(':checked') ?
    $(".registrationByVal").html('Klinik') : $(".registrationByVal").html('Dokter')  
})
</script>
@endsection