@extends('layouts.visitor.main')
@section('content')
  @component('components.blog.detail', ['content' => $content, 'blogs' => $blogs, 'route' => $route]) @endcomponent
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
