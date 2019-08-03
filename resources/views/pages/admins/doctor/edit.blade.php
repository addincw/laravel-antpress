@extends('layouts.admin.main')

@section('content')
<form class="form" action="{{ url($route . '/' . $doctor->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @component($routeView . '._form', [
    'doctor' => $doctor,
    'route' => $route,
  ]) @endcomponent
</form>
@endsection
