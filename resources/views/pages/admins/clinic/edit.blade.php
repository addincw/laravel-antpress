@extends('layouts.admin.main')

@section('content')
<form class="form" action="{{ url($route . '/' . $clinic->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}

  @component($routeView . '._form', ['clinic' => $clinic]) @endcomponent
</form>
@endsection
