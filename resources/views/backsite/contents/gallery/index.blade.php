@extends('backsite.layout.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Galeri

      <div class="btn-group pull-right">
        <button type="button" class="btn btn-primary btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-plus"></i> Tambah Galeri</button>
          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(103px, 41px, 0px);">
              <a class="dropdown-item" href="{{ url($route . '/create') }}"><i class="ft-copy"></i> Banyak Galeri </a>
              <a class="dropdown-item" href="{{ url($route . '/single') }}"><i class="ft-square"></i> Single Galeri </a>
              <a class="dropdown-item" href="{{ url($route . '/video') }}"><i class="ft-video"></i> Video </a>
          </div>
      </div>

    </h4>
  </div>
  <div class="card-body">
    @component('components.gallery.thumbnail', [
      'route' => $route,
      'tabs' => $types,
      'selectedTab' => $selectedType,
      'selectedContent' => $selectedContent,
      'galeries' => $galeries
    ]) @endcomponent    
  </div>
</div>
@endsection
