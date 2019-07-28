@extends('layouts.admin.main')

@section('content')
<form class="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  @component($routeView . '._form', ['route' => $route, 'categories' => $categories]) @endcomponent
</form>
@endsection
