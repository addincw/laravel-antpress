@extends('layouts.admin.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Setting
      <a class="btn btn-primary white pull-right" href="{{ url($route . '/create') }}">Tambah Setting <i class="ft-plus"></i> </a>
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="recent-orders" class="table table-striped table-bordered table-hover table-xl mb-0">
        <thead>
          <tr>
            <th class="">Waktu Pendaftaran</th>
            <th class="">Mulai berlaku tanggal</th>
            <th class="">Status berlaku</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($settings as $setting)
          <tr>
            <td class="text-truncate">
              <div style="display: flex; align-items: center;">
                  {{ $setting->hour_start . ':' . $setting->minutes_start }} - {{ $setting->hour_end . ':' . $setting->minutes_end }}
                </span>
              </div>
            </td>
            <td>{{ date('d F, Y', strtotime($setting->start_date)) }} </td>
            <td>
              @if($activeSetting == $setting->start_date)
              <div class="badge badge-pill badge-success">Sedang Berlaku</div>
              @else
              <div class="badge badge-pill badge-secondary">Tidak Berlaku</div>
              @endif
            </td>
            <td class="text-truncate text-center">
              <a href='{{ url("$route/$setting->id/edit") }}' class="btn btn-sm btn-icon btn-pure info"><i class="ft-edit"></i></a>
              <a href="{{ url($route . '/' . $setting->id) }}" class="btn btn-sm btn-icon btn-pure danger deleteBtn"><i class="ft-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<form class="form" method="post" style="display: none;">
  {{ csrf_field() }}
  @method('DELETE')
</form>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/extensions/sweetalert.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('.deleteBtn').on('click', function(){
    swal({
            title: "Yakin menghapus data?",
            text: "Data yang sudah dihapus, tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            buttons: {
              cancel: {
                  text: "Tidak, Batalkan!",
                  value: null,
                  visible: true,
                  className: "btn-warning",
                  closeModal: true,
              },
              confirm: {
                  text: "Ya, Hapus sekarang!",
                  value: true,
                  visible: true,
                  className: "",
                  closeModal: false
              }
            }
        })
        .then((isConfirm) => {
            if (isConfirm) {
              let deleteLink = $(this).attr("href")
              $("form.form").attr("action", deleteLink)
              $("form.form").submit();
            }
            swal.close();
        });

    return false
  });
})
</script>
@endsection
