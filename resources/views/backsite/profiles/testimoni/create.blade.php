@extends('backsite.layout.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Tambah Testimoni
    </h4>
  </div>
  <div class="card-body">
    <form class="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @component($routeView . '._form') @endcomponent
  </div>
  <div class="card-footer">
      <div class="form-actions">
        <button type="submit" class="btn btn-block btn-success">
          <i class="la la-check-square-o"></i> Save
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
