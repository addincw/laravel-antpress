@extends('layouts.admin.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Konten
      <a class="btn btn-primary white pull-right" href="{{ url($route . '/create') }}">Tambah Konten <i class="ft-plus"></i> </a>
    </h4>
  </div>
  <div class="card-body">
    <div class="media-list list-group">
      @foreach($contents as $content)
			<div class="list-group-item list-group-item-action media">
        <span class="media-left">
          <img class="media-object" src="{{ $content->thumbnail_url }}" alt="{{ $content->slug }}" style="width: 84px;height: 84px;">
        </span>
        <span class="media-body" style="color: black !important;">
          <strong style="font-size:20px;">{{ $content->title }}</strong>
          <br>
          <span>{{ date('d M Y', strtotime($content->created_at)) }}</span>
        </span>
        <div class="media-right">
          <a href='{{ url("$route/$content->id/edit") }}' class="btn btn-sm btn-icon btn-pure info"><i class="ft-edit"></i></a>
          @if($content->is_delete)
          <a href="{{ url($route . '/' . $content->id) }}" class="btn btn-sm btn-icon btn-pure danger deleteBtn"><i class="ft-trash"></i></a>
          @endif
        </div>
			</div>
      @endforeach
		</div>

    <div class="table-responsive" style="display: none;">
      <table id="recent-orders" class="table table-striped table-bordered table-hover table-xl mb-0">
        <thead>
          <tr>
            <th class="">Tanggal Post</th>
            <th class="">Name</th>
            <th class="">Category</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contents as $content)
          <tr>
            <td class="text-truncate">
              {{ date('d M Y', strtotime($content->created_at)) }}
            </td>
            <td class="text-truncate">
              <div style="display: flex; align-items: center;">
                <span class="avatar mr-2">
                  <img class="box-shadow-2" src="{{ $content->thumbnail_url }}" alt="avatar">
                </span>
                <span>
                  <strong>{{ $content->title }}</strong>
                </span>
              </div>
            </td>
            <td class="text-truncate">
              {{ $content->category->title }}
            </td>
            <td class="text-truncate text-center">
              <a href='{{ url("$route/$content->id/edit") }}' class="btn btn-sm btn-icon btn-pure info"><i class="ft-edit"></i></a>
              @if($content->is_delete)
              <a href="{{ url($route . '/' . $content->id) }}" class="btn btn-sm btn-icon btn-pure danger deleteBtn"><i class="ft-trash"></i></a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
