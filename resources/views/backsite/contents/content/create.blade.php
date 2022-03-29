@extends('backsite.layout.main')

@section('content')
<form class="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="type" value="{{ $type }}">
  @component($routeView . '._form', [
    'route' => $route,
    'categories' => $categories,
    'type' => $type
  ]) @endcomponent
</form>
@endsection
