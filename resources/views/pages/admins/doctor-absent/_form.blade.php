<?php $leave = !empty($leave) ? $leave : NUll; ?>
<div class="form-body">
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
        <option value="{{ $doctor->id }}" @if($leave && $leave->doctor_id === $doctor->id) selected @endif>{{ $doctor->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Tanggal Mulai</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <span class="ft-clock"></span>
            </span>
          </div>
          <input type='text' class="form-control pickadate" placeholder="Tanggal Mulai" name="start_date" @if(!empty($leave)) value="{{ $leave->start_date }}" @endif />
        </div>
        <small class="text-muted">Isi tanggal mulai ijin.
        </small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Tanggal Akhir</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <span class="ft-clock"></span>
            </span>
          </div>
          <input type='text' class="form-control pickadate" placeholder="Tanggal Akhir" name="end_date" @if(!empty($leave)) value="{{ $leave->end_date }}" @endif />
        </div>
        <small class="text-muted">Isi tanggal akhir ijin.
        </small>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Keterangan</label>
    <textarea class="form-control" name="content">@if(!empty($leave)) {{ $leave->content }} @endif</textarea>
    <small class="text-muted">Keterangan mengapa ijin.
    </small>
  </div>
</div>

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/plugins/pickers/daterange/daterange.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$('select').select2();

$('.pickadate').pickadate();
</script>
@endsection