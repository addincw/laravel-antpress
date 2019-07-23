<?php $galery = !empty($galery) ? $galery : NUll; ?>
<div class="form-body">
  <div class="form-group">
    <label for="fieldName">Nama Konten</label>
    <div class="position-relative has-icon-left">
      <input type="text" id="fieldName" class="form-control" placeholder="Nama Konten" name="title" value="{{ $galery ? $galery->title : '' }}">
      <div class="form-control-position">
        <i class="ft-file-text"></i>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="fieldDescription">Description</label>
    <div class="position-relative has-icon-left">
      <textarea id="fieldDescription" rows="5" class="form-control" name="description" placeholder="Isi Konten">@if($galery) {{ $galery->description }} @endif</textarea>
      <div class="form-control-position">
        <i class="ft-file"></i>
      </div>
    </div>
  </div>
</div>
@section('css')
<style type="text/css">
</style>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection
