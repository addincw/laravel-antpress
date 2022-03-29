@extends('frontsite.layout.main')
@section('content')
  @component('components.blog.detail', [
    'content' => $content,
    'blogs' => $blogs,
    'route' => $route
  ]) @endcomponent
@endsection

@section('footer')
  @include('frontsite.layout.footer')
  @parent
@endsection
