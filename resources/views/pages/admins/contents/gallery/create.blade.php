@extends('layouts.admin.main')

@section('content')
<div class="card">
  <div class="card-header">
    <div class="card-title">
      Upload Media
    </div>
  </div>
  <div class="card-body" style="padding-top: 0px;">
    <form class="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @component($routeView . '._form') @endcomponent
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-block btn-success">
      <i class="la la-check-square-o"></i> Save
    </button>
    </form>
  </div>
</div>
@endsection
