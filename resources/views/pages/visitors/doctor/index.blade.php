@extends('layouts.visitor.main')

@section('content')
<div class="card text-white bg-blue" style="height: 307.275px;">
  <div class="card-content">
    <div class="card-body pt-3">
      <img src="{{ asset('theme/modern-admin-1.0/app-assets/images/elements/11.png') }}" alt="element 06" width="190" class="float-right">
      <h1 class="mb-3 text-white">New Arriaval</h1>
      <p class="card-text" style="width: 50%;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
</div>

  @component('components.carousel-doctor', ['doctors' => $doctors]) @endcomponent
  @component('components.carousel-doctor', ['doctors' => $doctors]) @endcomponent
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
