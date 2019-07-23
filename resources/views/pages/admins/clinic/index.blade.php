@extends('layouts.admin.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Klinik
      <a class="btn btn-primary white pull-right" href="{{ url($route . '/create') }}">Tambah Klinik <i class="ft-plus"></i> </a>
    </h4>
  </div>
  <div class="card-body">
    <div class="media-list list-group">
      @foreach($clinics as $clinic)
			<div class="list-group-item list-group-item-action media">
        <span class="media-left">
          <img class="media-object" src="{{ $clinic->thumbnail_url }}" alt="{{ $clinic->slug }}" style="width: 84px;height: 84px;">
        </span>
        <span class="media-body" style="color: black !important;">
          <strong style="font-size:20px;">{{ $clinic->title }}</strong>
          <br>
          <span>{{ date('d M Y', strtotime($clinic->created_at)) }}</span>
        </span>
        <div class="media-right">
          <a href='{{ url("$route/$clinic->id/edit") }}' class="btn btn-sm btn-icon btn-pure info"><i class="ft-edit"></i></a>
          <a href="{{ url($route . '/' . $clinic->id) }}" class="btn btn-sm btn-icon btn-pure danger deleteBtn"><i class="ft-trash"></i></a>
        </div>
			</div>
      @endforeach
		</div>
  </div>
</div>

<form class="form-delete" method="post" style="display: none;">
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
              $("form.form-delete").attr("action", deleteLink)
              $("form.form-delete").submit();
            }
            swal.close();
        });

    return false
  });
})
</script>
@endsection
