<?php $testimoni = !empty($testimoni) ? $testimoni : NUll; ?>
<div class="form-body">
  <div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Preview</label>
        <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
          @if(!empty($testimoni))
          <a href="{{ asset('img/testimoni/' . $testimoni->thumbnail) }}" itemprop="contentUrl" data-size="480x360">
              <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $testimoni->thumbnail_url }}" itemprop="thumbnail" alt="Image {{ $testimoni->name }}">
          </a>
          @else
          <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
          @endif
        </figure>
			</div>
      <div class="form-group">
        <input type="file" class="form-control" id="fieldPhoto" name="thumbnail" onchange="previewImage()">
      </div>
		</div>
		<div class="col-md-9">
      <div class="form-group">
        <label for="fieldName">Name</label>
        <div class="position-relative has-icon-left">
          <input type="text" id="fieldName" class="form-control" placeholder="Nama Pemberi Testimoni" name="name" value="{{ $testimoni ? $testimoni->name : '' }}">
          <div class="form-control-position">
            <i class="ft-user"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="fieldName">From</label>
        <div class="position-relative has-icon-left">
          <input type="text" id="fieldFrom" class="form-control" placeholder="Asal Instansi" name="from" value="{{ $testimoni ? $testimoni->from : '' }}">
          <div class="form-control-position">
            <i class="ft-briefcase"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="fieldDescription">Description</label>
        <div class="position-relative has-icon-left">
          <textarea id="fieldDescription" rows="5" class="form-control" name="description" placeholder="Isi Testimoni">@if($testimoni) {{ $testimoni->body }} @endif</textarea>
          <div class="form-control-position">
            <i class="ft-file"></i>
          </div>
        </div>
      </div>
		</div>
	</div>

</div>
@section('css')
<style type="text/css">
.img-thumbnail{ width: 100%; }
</style>
@endsection
@section('js')
<script type="text/javascript">
function previewImage() {
  var oFReader = new FileReader();
   oFReader.readAsDataURL(document.getElementById("fieldPhoto").files[0]);

  oFReader.onload = function(oFREvent) {
    document.getElementById("fieldPhotoPreview").src = oFREvent.target.result;
  };
};
</script>
@endsection
