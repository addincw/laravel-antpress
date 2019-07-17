@extends('layouts.visitor.main')

@section('content')
<div class="row">
  <div class="col-md-4 col-12">
    <div class="card" style="margin: 0px;">
      <div class="card-content">
        @component('components.carousel') @endcomponent
      </div>
    </div>
  </div>
  <div class="col-md-8 col-12">
    <div class="card" style="height: 100%;">
      <div class="card-header">
        <h1 class="card-title">Lorem ipsum dolor sit amet.</h1>
      </div>
      <div class="card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
  </div>
</div>

<h2 class="mt-3 mb-3">Dokter Terkait</h2>
@component('components.carousel-doctor') @endcomponent
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
