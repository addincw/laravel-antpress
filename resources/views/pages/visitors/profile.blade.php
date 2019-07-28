@extends('layouts.visitor.main')
@section('content')
<h1 class="mb-3">{{ $content->title }}</h1>
<div class="card">
  <div class="card-content">
    <img class="card-image img-fluid" src="{{ $content->thumbnail_url }}" alt="image-{{ $content->slug }}">
    <div class="card-body">
      <p>{{ $content->description }}</p>
    </div>
  </div>
</div>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
