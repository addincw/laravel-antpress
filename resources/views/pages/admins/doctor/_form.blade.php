<?php $doctor = !empty($doctor) ? $doctor : NUll; ?>
<div class="form-body">
  <div class="row">
		<div class="col-md-3">
      <div class="card">
        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4">
          <h1 class="card-title">
            <i class="ft-settings"></i> Pengaturan
          </h1>
        </div>

        <div class="collapse-icon accordion-icon-rotate">
          <div class="card-content">
            <div class="card-body">
              <div class="form-group">
                <label>Preview</label>
                <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                  @if(!empty($doctor))
                  <a href="{{ asset('img/doctor/' . $doctor->image) }}" itemprop="contentUrl" data-size="480x360">
                      <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $doctor->image_url }}" itemprop="thumbnail" alt="Image {{ $doctor->name }}">
                  </a>
                  @else
                  <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
                  @endif
                </figure>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" id="fieldPhoto" name="image" onchange="previewImage()">
              </div>
            </div>
          </div>

          <div class="card-content">
            <div class="card-body">
              <div class="float-right">
                <input type="checkbox" name="is_active" id="is_active" class="switchery" data-size="sm" @if(empty($doctor) || $doctor->is_active) checked @endif/>
              </div>
              <label for="is_active" class="font-medium-1">Status aktif dokter</label>
            </div>
          </div>
        </div>
      </div>
		</div>

		<div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <div class="pull-right">
            <button type="submit" class="btn btn-success">
              <i class="la la-check-square-o"></i> Save
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="fieldName">Name</label>
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldName" class="form-control" placeholder="Nama dokter" name="name" value="{{ $doctor ? $doctor->name : '' }}">
              <div class="form-control-position">
                <i class="ft-user"></i>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="fieldSpecialist">Spesialis</label>
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldSpecialist" class="form-control" placeholder="Spesialis" name="specialist" value="{{ $doctor ? $doctor->specialist : '' }}">
              <div class="form-control-position">
                <i class="ft-briefcase"></i>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="float-right">
              <span class="genderValue mr-2">
                @if(empty($doctor) || $doctor->gender)
                  laki - laki
                @else
                  perempuan
                @endif
              </span>
              <input type="checkbox" name="gender" id="gender" class="switchery" data-size="sm" @if(empty($doctor) || $doctor->gender) checked @endif/>
            </div>
            <label for="gender" class="font-medium-1">Jenis Kelamin</label>
          </div>
        </div>
      </div>
		</div>
	</div>

</div>
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<style type="text/css">
.img-thumbnail{ width: 100%; }
</style>
@endsection
@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
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

function previewImage() {
  var oFReader = new FileReader();
   oFReader.readAsDataURL(document.getElementById("fieldPhoto").files[0]);

  oFReader.onload = function(oFREvent) {
    document.getElementById("fieldPhotoPreview").src = oFREvent.target.result;
  };
};

$(document).ready(function () {
  $("#gender").on('change', function () {
    let value = $(this).is(':checked') ? 'laki - laki' : 'perempuan'
    $(".genderValue").html(value)
  })
})
</script>
@endsection
