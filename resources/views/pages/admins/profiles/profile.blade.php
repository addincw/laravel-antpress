@extends('layouts.admin.main')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Kontak
      <button id="editBtn" class="btn btn-md btn-info pull-right">
        Perbarui Kontak
        <i class="ft-edit"></i>
      </button>
      <button id="cancelBtn" class="btn btn-md btn-warning pull-right" style="display: none">
        Batalkan
        <i class="ft-x-square"></i>
      </button>
    </h4>
  </div>
  <div class="card-body">
    <form class="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @if($profile)
      <input type="hidden" name="id" value="{{ $profile->id }}">
      @endif
			<div class="form-body">
        <div class="form-group">
          <label for="">Logo</label>
          <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
            @if(!empty($profile))
            <a href="{{ asset('img/profile/' . $profile->logo) }}" itemprop="contentUrl">
              <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $profile->logo_url }}" itemprop="thumbnail" alt="Image {{ $profile->name }}">
            </a>
            @else
            <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
            @endif
          </figure>
        </div>

        <div class="form-group">
          <input type="file" class="form-control" id="fieldPhoto" name="logo" onchange="previewImage()">
        </div>

        <div class="form-group">
          <label for="">Logo Full</label>
          <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
            @if(!empty($profile))
            <a href="{{ asset('img/profile/' . $profile->logo_full) }}" itemprop="contentUrl">
              <img id="fieldPhotoPreviewFull" class="img-thumbnail img-fluid" src="{{ $profile->logo_full_url }}" itemprop="thumbnail" alt="Image {{ $profile->name }}">
            </a>
            @else
            <img id="fieldPhotoPreviewFull" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
            @endif
          </figure>
        </div>

        <div class="form-group">
          <input type="file" class="form-control" id="fieldPhotoFull" name="logo_full" onchange="previewImageFull()">
        </div>

				<div class="form-group">
					<label for="fieldName">Name</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldName" class="form-control" placeholder="Nama Perusahaan" name="name" value="{{ $profile ? $profile->title : '' }}">
						<div class="form-control-position">
							<i class="ft-briefcase"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldDescription">Description</label>
					<div class="position-relative has-icon-left">
						<textarea id="fieldDescription" rows="5" class="form-control" name="description" placeholder="Deskripsi Perusahaan">{{ $profile ? $profile->description : '' }}</textarea>
						<div class="form-control-position">
							<i class="ft-file"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldPhone">Phone</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldPhone" class="form-control" placeholder="Telpon Perusahaan" name="phone" value="{{ $profile ? $profile->phone : '' }}">
						<div class="form-control-position">
							<i class="ft-phone"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldWA">Whatsapp</label>
					<div class="position-relative has-icon-left">
						<input type="number" id="fieldWA" class="form-control" placeholder="Whatsapp Perusahaan" name="whatsapp" value="{{ $profile ? $profile->whatsapp : '' }}">
						<div class="form-control-position">
							<i class="la-whatsapp"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldTele">Telegram</label>
					<div class="position-relative has-icon-left">
						<input type="number" id="fieldTele" class="form-control" placeholder="Telegram Perusahaan" name="telegram" value="{{ $profile ? $profile->telegram : '' }}">
						<div class="form-control-position">
							<i class="ft-navigation"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldEmergency">Emergency Call</label>
					<div class="position-relative has-icon-left">
						<input type="number" id="fieldEmergency" class="form-control" placeholder="Emergency Call Perusahaan" name="emergency_call" value="{{ $profile ? $profile->emergency_call : '' }}">
						<div class="form-control-position">
							<i class="la-ambulance"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldAddress">Address</label>
					<div class="position-relative has-icon-left">
						<input type="number" id="fieldAddress" class="form-control" placeholder="Alamat Perusahaan" name="address" value="{{ $profile ? $profile->address : '' }}">
						<div class="form-control-position">
							<i class="ft-map-pin"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldEmail">Email</label>
					<div class="position-relative has-icon-left">
						<input type="email" id="fieldEmail" class="form-control" placeholder="Email Perusahaan" name="email" value="{{ $profile ? $profile->email : '' }}">
						<div class="form-control-position">
							<i class="la la-briefcase"></i>
						</div>
					</div>
				</div>

        <h4 class="form-section"><i class="ft-globe"></i> Social Media</h4>
				<div class="form-group">
					<label for="fieldFacebook">Facebook</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldFacebook" class="form-control" placeholder="Facebook Perusahaan" name="facebook" value="{{ $profile ? $profile->facebook : '' }}">
						<div class="form-control-position">
							<i class="ft-facebook"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldTwitter">Twitter</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldTwitter" class="form-control" placeholder="Twitter Perusahaan" name="twitter" value="{{ $profile ? $profile->twitter : '' }}">
						<div class="form-control-position">
							<i class="ft-twitter"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldInstagram">Instagram</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldInstagram" class="form-control" placeholder="Instagram Perusahaan" name="instagram" value="{{ $profile ? $profile->instagram : '' }}">
						<div class="form-control-position">
							<i class="ft-instagram"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="fieldYoutube">Youtube</label>
					<div class="position-relative has-icon-left">
						<input type="text" id="fieldYoutube" class="form-control" placeholder="Youtube Perusahaan" name="youtube" value="{{ $profile ? $profile->youtube : '' }}">
						<div class="form-control-position">
							<i class="ft-play"></i>
						</div>
					</div>
				</div>

			</div>

  </div>
  <div class="card-footer">
      <div class="form-actions">
        <button type="submit" class="btn btn-block btn-success">
          <i class="la la-check-square-o"></i> Save
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('css')
<style type="text/css">
.img-thumbnail{ width: 30%; }
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
  function previewImageFull() {
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("fieldPhotoFull").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("fieldPhotoPreviewFull").src = oFREvent.target.result;
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
