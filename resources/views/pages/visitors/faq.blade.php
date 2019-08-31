@extends('layouts.visitor.main')
@section('content')
<div class="header-section mb-3">
  <p class="header-section__title"> {{ $faq->question }} </p>
</div>

<section class="profile">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <p>{!! html_entity_decode($faq->answer) !!}</p>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
