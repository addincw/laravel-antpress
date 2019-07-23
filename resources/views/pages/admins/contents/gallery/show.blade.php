@extends('layouts.admin.preview')

@section('content')
  @component('components.blog.detail', ['content' => $content]) @endcomponent
@endsection
