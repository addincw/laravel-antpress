@extends('frontsite.layout.main')
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

        <div class="mt-2">
          @component('components.gallery.thumbnail', [
            'route' => $route,
            'tabs' => $types,
            'selectedTab' => $typeFile,
            'tabLink' => url($route . '/' . $content->slug . '?type_file='),
            'galeries' => $galeries,
            'useFilter' => 'false',
            'isEditable' => 'false'
          ]) @endcomponent
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer')
  @include('frontsite.layout.footer')
  @parent
@endsection
