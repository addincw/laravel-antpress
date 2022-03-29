@extends('backsite.layout.main')

@section('content')
<div class="card">
  <div class="card-header">
    <div class="card-title">
      Upload Galeri
    </div>
  </div>
  <div class="card-body" style="padding-top: 0px;">
    <div class="form-body">
      <div class="form-group">
        <label for="fieldContent">Pilih Konten</label>
        <select id="fieldContent" class="form-control">
          <option value="">pilih konten</option>
          @foreach($contents as $content)
          <option 
            value="{{ $content->id }}"
            @if(!empty($selectedContentId) && ($selectedContentId == $content->id))
            selected
            @endif> {{ $content->title }}</option>
          @endforeach
        </select>
        <p class="block-tag text-left" style="display: none;">
          <small class="badge badge-danger">Konten tidak boleh kosong</small>
        </p>
      </div>
    </div>

    <form id="form-dropzone" class="form dropzone" action="{{ url($route) }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="content_id">
    </form>

  </div>
  <div class="card-footer">
    <button id="submitFormDropzone" class="btn btn-block btn-success">
      <i class="la la-check-square-o"></i> Save
    </button>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/plugins/file-uploaders/dropzone.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/dropzone.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    @if(!empty($selectedContentId))
      $("input[name='content_id']").val('{{ $selectedContentId }}')
    @endif
    
    $("#fieldContent").on('change', function () {
      $("input[name='content_id']").val($(this).val())
      $("#fieldContent").removeClass("border-danger")
      $("#fieldContent + p").hide()
    })
})

Dropzone.options.formDropzone = { // The camelized version of the ID of the form element
  // The configuration for normal form
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 100,
  addRemoveLinks: true,
  dictRemoveFile: " Hapus",
  acceptedFiles: "image/*",
  // The setting up of the dropzone
  init: function () {
    const myDropzone = this
    //can be event listener
    $("#submitFormDropzone").on("click", function(e) {
      e.preventDefault();
      if ($("input[name='content_id']").val() === '') {
        $("#fieldContent").focus()
        $("#fieldContent").addClass("border-danger")
        $("#fieldContent + p").show()
        return
      }

      $(this).html(`<i class="ft-loader spinner"></i> loading...`)
      $(this).attr('disabled', true)
      myDropzone.processQueue();
    });
  },
  error: function (e) {
    location.reload(true)
  },
  success: function (e) {
    window.location.href = "{{ url($route) }}"
  }
}
</script>
@endsection
