<?php $gallery = !empty($gallery) ? $gallery : NUll; ?>
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
                <label>Konten</label>
                <select id="fieldContent" class="form-control" name="content_id">
                  <option value="">pilih konten</option>
                  @foreach($contents as $content)
                  <?php
                      $isEdit = !empty($gallery) && $content->id == $gallery->content_id;
                      $isAutoSelected = !empty($selectedContentId) && $content->id == $selectedContentId;
                  ?>
                  <option value="{{ $content->id }}" @if( $isEdit || $isAutoSelected ) selected @endif>
                      {{ $content->title }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="form-group">
                <label>Preview Gambar</label>
                <figure itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                  @if(!empty($gallery))
                  <a href="{{ asset('/storage/' . $gallery->file) }}" itemprop="contentUrl" data-size="480x360">
                      <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ $gallery->file_url }}" itemprop="thumbnail" alt="Image-{{ $gallery->slug }}">
                  </a>
                  @else
                  <img id="fieldPhotoPreview" class="img-thumbnail img-fluid" src="{{ asset('img/no-image.png') }}" itemprop="thumbnail" alt="No Image">
                  @endif
                </figure>
              </div>
              <div class="form-group">
                <input type="file" class="form-control" id="fieldPhoto" name="file" onchange="previewImage('fieldPhoto')">
              </div>
            </div>
          </div>
          <div class="card-content">
            <div class="card-body">
              <div class="float-right">
                <input type="checkbox" name="is_highlight" id="is_highlight" class="switchery" data-size="sm" @if(empty($gallery) || $gallery->is_highlight) checked @endif/>
              </div>
              <label for="is_highlight" class="font-medium-1">halaman utama</label>
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
        <div class="card-body" style="padding-top: 0px;">

          <div class="form-group">
            <label for="">Judul Gambar</label>
            <div class="position-relative has-icon-left">
              <input type="text" id="fieldName" class="form-control" placeholder="Nama gambar" name="title" value="{{ $gallery ? $gallery->title : '' }}">
              <div class="form-control-position">
                <i class="ft-file-text"></i>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">Deskripsi Gambar</label>
            <div class="position-relative has-icon-left">
              <textarea id="fieldDescription" rows="5" class="form-control" name="description" placeholder="Isi deskripsi gambar">@if($gallery) {{ $gallery->description }} @endif</textarea>
              <div class="form-control-position">
                <i class="ft-file-text"></i>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
