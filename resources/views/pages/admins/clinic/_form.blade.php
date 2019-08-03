<?php $clinic = !empty($clinic) ? $clinic : NUll; ?>
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
                <label>Thumbnail Klinik</label>
                <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                  @if(!empty($clinic))
                  <a href="{{ asset('img/' . $clinic->thumbnail) }}" itemprop="contentUrl" data-size="480x360">
                      <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $clinic->thumbnail_url }}" itemprop="thumbnail" alt="Image-{{ $clinic->slug }}">
                  </a>
                  @else
                  <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
                  @endif
                </figure>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" id="fieldPhoto" name="thumbnail" onchange="previewImage('fieldPhoto')">
              </div>
            </div>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="float-right">
                <input type="checkbox" name="is_published" id="is_published" class="switchery" data-size="sm" @if(empty($clinic) || $clinic->is_published) checked @endif/>
              </div>
              <label for="is_published" class="font-medium-1">Tampilkan Klinik</label>
            </div>
          </div>
  			</div>
      </div>

		</div>

		<div class="col-md-9">
      <div class="card" style="min-height: 330px;">
        <div class="card-header">
          <div class="pull-right">
            <button type="submit" class="btn btn-success">
              <i class="la la-check-square-o"></i> Save
            </button>
          </div>
        </div>
        <div class="card-body" style="padding-top: 0px;">
          <div class="form-group">
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldName" class="form-control" placeholder="Nama Klinik" name="title" value="{{ $clinic ? $clinic->title : '' }}">
              <div class="form-control-position">
                <i class="ft-file-text"></i>
              </div>
            </div>
          </div>

          <textarea id="fieldDescription" name="description">@if($clinic) {{ html_entity_decode($clinic->description) }} @endif</textarea>

          <h4 class="form-section mt-5"><i class="ft-user-plus"></i> Daftar Dokter</h4>
          <div class="doctor-repeater">
            <div data-repeater-list="doctors">
              <div data-repeater-item style="display: none;">
                <div class="row mb-1">
                  <div class="col-9 col-xl-10">
                    <input type="hidden" name="clinic_doctor_id">
                    <select class="form-control select2" name="doctor_id" style="width: 100%;"  data-placeholder="Pilih dokter..">
                      <option value=""></option>
                      @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialist }})</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-2 col-xl-1">
                    <button type="button" data-repeater-delete class="btn btn-icon btn-danger mr-1"><i class="ft-trash"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" data-repeater-create class="btn btn-primary">
              <i class="ft-plus"></i> Tambah Dokter
            </button>
          </div>

        </div>
      </div>
		</div>
	</div>

</div>
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/editors/summernote.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<style type="text/css">
.img-thumbnail{ width: 100%; }
</style>
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/codemirror/lib/codemirror.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/codemirror/mode/xml/xml.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
type="text/javascript"></script>

<script type="text/javascript">
var baseUrl = "{{ url('/') }}"
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

function previewImage (field) {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById(field).files[0]);

  oFReader.onload = function(oFREvent) {
    document.getElementById(`${field}Preview`).src = oFREvent.target.result;
  };
};

$(document).ready(function () {
  var $repeater = $(".doctor-repeater").repeater({
    initEmpty: true
  });

  $(".select2").select2();
  $('#fieldDescription').summernote();

  var doctorList = []
  <?php if(!empty($clinic) && !empty($clinic->doctors)): ?>
  doctorList = JSON.parse(`<?php echo (object) $clinic->doctors; ?>`)

  $repeater.setList(doctorList.map((doctor) => {
    return {
      clinic_doctor_id: doctor.id,
      doctor_id: doctor.doctor_id
    }
  }))
  <?php endif; ?>
})
</script>
@endsection
