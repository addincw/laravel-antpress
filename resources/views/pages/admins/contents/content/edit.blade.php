@extends('layouts.admin.main')

@section('content')
<form class="form" action="{{ url($route . '/' . $content->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @component($routeView . '._form', [
    'route' => $route,
    'content' => $content,
    'categories' => $categories,
    'type' => $type
  ]) @endcomponent
</form>
@endsection
