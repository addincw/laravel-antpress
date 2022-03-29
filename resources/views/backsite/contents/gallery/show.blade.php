@extends('backsite.layout.preview')

@section('content')
  @component('components.blog.detail', ['content' => $content]) @endcomponent
@endsection
