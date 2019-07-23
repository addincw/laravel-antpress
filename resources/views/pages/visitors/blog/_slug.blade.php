@extends('layouts.visitor.main')
@section('content')
  @component('components.blog.detail') @endcomponent
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
