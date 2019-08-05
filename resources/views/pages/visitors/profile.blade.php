@extends('layouts.visitor.main')
@section('content')
<div class="header-section mb-3">
  <p class="header-section__title"> {{ $content->title }} </p>
</div>

<section class="profile">
  <div class="card">
    <div class="card-content">
      <div class="profile__thumbnail">
        <img class="card-image img-fluid" src="{{ $content->thumbnail_url }}" alt="image-{{ $content->slug }}" width="100%">
      </div>
      <div class="card-body">
        <p>{!! html_entity_decode($content->description) !!}</p>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
