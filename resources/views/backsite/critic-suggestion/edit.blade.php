@extends('backsite.layout.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Kritik dan Saran {{ $criticSuggestion->id }}
    </h4>
  </div>
  <div class="card-body">
    <form class="form" action="{{ url($route . '/' . $criticSuggestion->id) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      @component($routeView . '._form', ['criticSuggestion' => $criticSuggestion]) @endcomponent
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
