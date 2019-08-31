@extends('layouts.admin.main')

@section('content')
<?php 
    if(!empty($gallery)) {
        $gallery = $gallery;
        $formAction = url($route . '/video/' . $gallery->id);
    }else{
        $gallery = NULL; 
        $formAction = url($route . '/video');
    }
?>
<form class="form" action="{{ $formAction }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}

  @if(!empty($gallery)) {{ method_field('PUT') }} @endif
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
                    <option
                    value="{{ $content->id }}"
                    @if(!empty($gallery) && $content->id === $gallery->content_id)
                    selected
                    @endif
                    >{{ $content->title }}</option>
                    @endforeach
                    </select>
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
                <label for="">Judul Video</label>
                <div class="position-relative has-icon-left">
                <input type="text" id="fieldName" class="form-control" placeholder="Nama gambar" name="title" value="{{ $gallery ? $gallery->title : '' }}">
                <div class="form-control-position">
                    <i class="ft-file-text"></i>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Link Youtube Video</label>
                <div class="position-relative has-icon-left">
                <input type="text" class="form-control" name="file" placeholder="link youtube video" value="@if($gallery) {{ $gallery->file }} @endif" />
                <div class="form-control-position">
                    <i class="ft-link"></i>
                </div>
                </div>
            </div>

            </div>
        </div>
        </div>
    </div>

  </div>

</form>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
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
</script>
@endsection
