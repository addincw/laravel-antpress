@extends('backsite.layout.main')

@section('content')
<form class="form" action="{{ url($route . '/' . $content->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @component($routeView . '._form', [
    'route' => $route,
    'content' => $content,
    'galeries' => $galeries,
    'categories' => $categories,
    'types' => $types,
    'type' => $type
  ]) @endcomponent
</form>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-9">  
    <div class="card">
      <div class="card-header border-bottom-blue-grey border-bottom-lighten-4">
        <h1 class="card-title">
          <i class="ft-paperclip"></i> Lampiran File
        </h1>
      </div>
      <div class="card-body">
        @component('components.gallery.thumbnail', [
          'route' => $route,
          'tabs' => $types,
          'selectedTab' => $typeFile,
          'tabLink' => url($route . '/' . $content->id . '/edit' . '?type=' . $type . '&type_file='),
          'galeries' => $galeries,
          'useFilter' => 'false',
        ]) @endcomponent
      </div>
    </div>
  </div>
</div>

@endsection
