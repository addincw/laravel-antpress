@extends('backsite.layout.main')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Configuration
      <button id="editBtn" class="btn btn-md btn-info pull-right">
        Edit
        <i class="ft-edit"></i>
      </button>
      <button id="cancelBtn" class="btn btn-md btn-warning pull-right" style="display: none">
        Cancel
        <i class="ft-x-square"></i>
      </button>
    </h4>
  </div>
  <div class="card-body">
    <form class="form" action="{{ url($route . '/' . $data->id) }}" method="post" enctype="multipart/form-data">
      @csrf
			@method('PUT')
			<div class="form-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="">Favicon</label>
							<figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
								@if(!empty($data))
								<a href="{{ asset('storage/site/' . $data->favicon) }}" itemprop="contentUrl">
									<img id="fieldFaviconPreview" class="img-thumbnail img-fluid" src="{{ $data->favicon_url }}" itemprop="thumbnail" alt="Image {{ $data->name }}">
								</a>
								@else
								<img id="fieldFaviconPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
								@endif
							</figure>
						</div>
						<div class="form-group">
							<input type="file" class="form-control" id="fieldFavicon" name="favicon" onchange="previewImage()">
						</div>

						<div class="form-group">
							<label for="">Logo</label>
							<figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
								@if(!empty($data))
								<a href="{{ asset('storage/site/' . $data->logo) }}" itemprop="contentUrl">
									<img id="fieldLogoPreview" class="img-thumbnail img-fluid" src="{{ $data->logo_url }}" itemprop="thumbnail" alt="Image {{ $data->name }}">
								</a>
								@else
								<img id="fieldLogoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
								@endif
							</figure>
						</div>
						<div class="form-group">
							<input type="file" class="form-control" id="fieldLogo" name="logo" onchange="previewImageFull()">
						</div>
					</div>
					<!-- endof .col-md-3 -->
					<div class="col-md-9">
						<div class="form-group">
							<label for="fieldName">Name</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldName" class="form-control" placeholder="Nama Perusahaan" name="name" value="{{ $data ? $data->title : '' }}">
								<div class="form-control-position">
									<i class="ft-briefcase"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldDescription">Description</label>
							<div class="position-relative has-icon-left">
								<textarea id="fieldDescription" rows="5" class="form-control" name="description" placeholder="Deskripsi Perusahaan">{{ $data ? $data->description : '' }}</textarea>
								<div class="form-control-position">
									<i class="ft-file"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldPhone">Phone</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldPhone" class="form-control" placeholder="Telpon Perusahaan" name="phone" value="{{ $data ? $data->phone : '' }}">
								<div class="form-control-position">
									<i class="ft-phone"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldWA">Whatsapp</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldWA" class="form-control" placeholder="Whatsapp Perusahaan" name="whatsapp" value="{{ $data ? $data->whatsapp : '' }}">
								<div class="form-control-position">
									<i class="la la-whatsapp"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldTele">Telegram</label>
							<div class="position-relative has-icon-left">
								<input type="number" id="fieldTele" class="form-control" placeholder="Telegram Perusahaan" name="telegram" value="{{ $data ? $data->telegram : '' }}">
								<div class="form-control-position">
									<i class="ft-navigation"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldAddress">Address</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldAddress" class="form-control" placeholder="Alamat Perusahaan" name="address" value="{{ $data ? $data->address : '' }}">
								<div class="form-control-position">
									<i class="ft-map-pin"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldEmail">Email</label>
							<div class="position-relative has-icon-left">
								<input type="email" id="fieldEmail" class="form-control" placeholder="Email Perusahaan" name="email" value="{{ $data ? $data->email : '' }}">
								<div class="form-control-position">
									<i class="la la-briefcase"></i>
								</div>
							</div>
						</div>

						<h4 class="form-section"><i class="ft-globe"></i> Social Media</h4>
						<div class="form-group">
							<label for="fieldFacebook">Facebook</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldFacebook" class="form-control" placeholder="Facebook Perusahaan" name="facebook" value="{{ $data ? $data->facebook : '' }}">
								<div class="form-control-position">
									<i class="ft-facebook"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldTwitter">Twitter</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldTwitter" class="form-control" placeholder="Twitter Perusahaan" name="twitter" value="{{ $data ? $data->twitter : '' }}">
								<div class="form-control-position">
									<i class="ft-twitter"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldInstagram">Instagram</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldInstagram" class="form-control" placeholder="Instagram Perusahaan" name="instagram" value="{{ $data ? $data->instagram : '' }}">
								<div class="form-control-position">
									<i class="ft-instagram"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="fieldYoutube">Youtube</label>
							<div class="position-relative has-icon-left">
								<input type="text" id="fieldYoutube" class="form-control" placeholder="Youtube Perusahaan" name="youtube" value="{{ $data ? $data->youtube : '' }}">
								<div class="form-control-position">
									<i class="ft-play"></i>
								</div>
							</div>
						</div>
					</div>
					<!-- endof .col-md-9 -->
				</div>
				<!-- endof .row -->
			</div>
  </div>
  <div class="card-footer">
      <div class="form-actions">
        <button type="submit" class="btn btn-block btn-success" name="save_configuration">
          <i class="la la-check-square-o"></i> Save
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('css')
<style type="text/css">
.img-thumbnail{ width: 100%; }
.card-title .btn i{
	margin-left: 5px;
}
</style>
@endsection

@section('js')
<script type="text/javascript">
  function previewImage() {
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("fieldFavicon").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("fieldFaviconPreview").src = oFREvent.target.result;
    };
  };
  function previewImageFull() {
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("fieldLogo").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("fieldLogoPreview").src = oFREvent.target.result;
    };
  };

  $(document).ready(function () {
    $("input, textarea").attr("readonly", true)
    $("button[type='submit']").css("display", "none")

    $("#editBtn").on("click", function () {
      $(this).css("display", "none")
      $("#cancelBtn").css("display", "block")
      $("input, textarea").removeAttr("readonly", true)
      $("button[type='submit']").css("display", "block")
    })
    $("#cancelBtn").on("click", function () {
      $(this).css("display", "none")
      $("#editBtn").css("display", "block")
      $("input, textarea").attr("readonly", true)
      $("button[type='submit']").css("display", "none")
    })
  })
</script>
@endsection
