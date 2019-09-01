<?php $content = !empty($content) ? $content : NUll; ?>
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
  				<div id="headingCollapse11" class="card-header border-bottom-blue-grey border-bottom-lighten-4">
  					<a data-toggle="collapse" href="#collapse11" aria-expanded="false" aria-controls="collapse11" class="card-title lead collapsed text-dark">Kategori & Tag</a>
  				</div>
  				<div id="collapse11" role="tabpanel" aria-labelledby="headingCollapse11" class="collapse">
  					<div class="card-content">
  						<div class="card-body">
                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control" name="category">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($content && $content->content_category_id === $category->id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="fieldTag">Tag</label>
                  <select id="fieldTag" name="tags[]" class="select2 form-control" multiple="multiple" style="width: 100%">
                  </select>
                </div>
  						</div>
  					</div>
  				</div>
  				<div id="headingCollapse12" class="card-header border-bottom-blue-grey border-bottom-lighten-4">
  					<a data-toggle="collapse" href="#collapse12" aria-expanded="false" aria-controls="collapse12" class="card-title lead collapsed text-dark">Thumbnail Konten</a>
  				</div>
  				<div id="collapse12" role="tabpanel" aria-labelledby="headingCollapse12" class="collapse" aria-expanded="false">
  					<div class="card-content">
  						<div class="card-body">
                <div class="form-group">
          				<label>Preview</label>
                  <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    @if(!empty($content))
                    <a href="{{ asset('img/' . $content->thumbnail) }}" itemprop="contentUrl" data-size="480x360">
                        <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $content->thumbnail_url }}" itemprop="thumbnail" alt="Image-{{ $content->slug }}">
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
  				</div>
  				<div id="headingCollapse14" class="card-header border-bottom-blue-grey border-bottom-lighten-4">
  					<a data-toggle="collapse" href="#collapse14" aria-expanded="false" aria-controls="collapse14" class="card-title lead collapsed text-dark">Dibuat Oleh</a>
  				</div>
  				<div id="collapse14" role="tabpanel" aria-labelledby="headingCollapse14" class="collapse" aria-expanded="false">
  					<div class="card-content">
  						<div class="card-body">
                <div class="form-group">
                  <label>Image</label>
                  <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    @if(!empty($content))
                    <a href="{{ asset('img/' . $content->creator_image_url) }}" itemprop="contentUrl" data-size="480x360">
                        <img id="fieldImagePreview" class="img-thumbnail img-fluid" src="{{ $content->creator_image_url }}" itemprop="thumbnail" alt="Image {{ $content->creator_name }}">
                    </a>
                    @else
                    <img id="fieldImagePreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
                    @endif
                  </figure>
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" id="fieldImage" name="creator_image" onchange="previewImage('fieldImage')">
                </div>
                <div class="form-group">
                  <label>Nama Pembuat</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" id="fieldCreatorName" class="form-control" name="creator_name" value="{{ $content ? $content->creator_name : '' }}">
                    <div class="form-control-position">
                      <i class="ft-user"></i>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Profesi</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" id="fieldCreatorTitle" class="form-control" name="creator_title" value="{{ $content ? $content->creator_title : '' }}">
                    <div class="form-control-position">
                      <i class="ft-briefcase"></i>
                    </div>
                  </div>
                </div>

  						</div>
  					</div>
  				</div>

          @if(!empty($content))
          <div class="card-content">
            <div class="card-body">
              <?php 
              $displayCountFiles = 'none';
              $countFoto = 0;
              $countVideo = 0;

              if($content->files->count() > 0){
                $displayCountFiles = 'block';
                $countFoto = $content->files()->where('file_type', 'like', 'image%')->count();
                $countVideo = $content->files()->where('file_type', 'like', 'video%')->count();
              }
              ?>
              <p style="display: {{ $displayCountFiles }}"><strong>{{ $countFoto }} foto, {{ $countVideo }} video.</strong></p>
              <div class="btn-group" style="width:100%">
                <button type="button" style="width:100%" class="btn btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-paperclip mr-1"></i> Tambah Galeri</button>
                <div class="dropdown-menu" x-placement="bottom-start" style="width: 100%; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(103px, 41px, 0px);">
                    <a class="dropdown-item" target="_blank" href="{{ url('admin/konten/galeri/create?content_id=' . $content->id) }}"><i class="ft-copy"></i> Banyak Galeri </a>
                    <a class="dropdown-item" target="_blank" href="{{ url('admin/konten/galeri/single?content_id=' . $content->id) }}"><i class="ft-square"></i> Single Galeri </a>
                    <a class="dropdown-item" target="_blank" href="{{ url('admin/konten/galeri/video?content_id=' . $content->id) }}"><i class="ft-video"></i> Video </a>
                </div>
              </div>
            </div>
          </div>
          @endif

          <div class="card-content">
            <div class="card-body">
              <div class="float-right">
                <input type="checkbox" name="is_published" id="is_published" class="switchery" data-size="sm" @if(empty($content) || $content->is_published) checked @endif/>
              </div>
              <label for="is_published" class="font-medium-1">Tampilkan Konten</label>
            </div>
          </div>
  			</div>
      </div>

		</div>

		<div class="col-md-9">
      <?php $minHeight = (!empty($content)) ? ($content->files->count() > 0) ? '442px' : '410px' : '330px'; ?>
      <div class="card" style="min-height:  {{ $minHeight }};">
        <div class="card-header">
          <div class="pull-right">
            @if(!empty($content))
            <a class="btn btn-outline-danger mr-1" style="color: red;" href='{{ url("$route/$content->id") }}'>
              <i class="ft-eye"></i> Pratinjau Halaman
            </a>
            @endif
            <button type="submit" class="btn btn-success">
              <i class="la la-check-square-o"></i> Save
            </button>
          </div>
        </div>
        <div class="card-body" style="padding-top: 0px;">
          <div class="form-group">
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldName" class="form-control" placeholder="Nama Kategori" name="title" value="{{ $content ? $content->title : '' }}">
              <div class="form-control-position">
                <i class="ft-file-text"></i>
              </div>
            </div>
          </div>

          <textarea id="fieldDescription" name="description">@if($content) {{ html_entity_decode($content->description) }} @endif</textarea>
        </div>
      </div>
		</div>
	</div>

  <input type="hidden" name="type" value="{{ $type }}">
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

function createTag (data) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      url: `${baseUrl}/api/tag`,
      type: "POST",
      data: { tag: data },
      success: function (result) {
        resolve(result)
      },
      error: function (err) {
        console.log(`[createTag] error : ${err}`)
        reject(err)
      }
    });
  })
}

$(document).ready(function () {
  @if(!empty($content->tags))
    @foreach($content->tags as $tag)
    var data = {
        id: "{{ $tag->tag_id }}",
        text: "{{ $tag->tag->name }}"
    };
    var newOption = new Option(data.text, data.id, true, true);
    $('#fieldTag').append(newOption).trigger('change');
    @endforeach
  @endif

  $("#fieldTag").select2({
    tags: true,
    ajax: {
      url: `${baseUrl}/api/tag`,
      data: function (params) {
        var query = { searchKey: params.term }
        return query;
      },
      processResults: function (data) {
        return {
          results: data.results.map((tag) => {
            tag.text = tag.name
            return tag
          })
        }
      }
    }
  }).on('change', function (e) {
      let isNew = $(this).find('[data-select2-tag="true"]');

      if(isNew.length){
          var r = confirm("do you want to create a tag?");
      		if (r) {
            createTag(isNew.val())
              .then(function (tag) {
                  isNew.replaceWith('<option selected value="'+tag.id+'">'+tag.name+'</option>');
              })
              .catch(function (err) {
                  $('.select2-selection__choice:last').remove();
                  $('.select2-search__field').val(isNew.val()).focus()
              })

          } else {
            $('.select2-selection__choice:last').remove();
      			$('.select2-search__field').val(isNew.val()).focus()
          }
      }
    });

  $('#fieldDescription').summernote();
})
</script>
@endsection
