@extends('layouts.visitor.main')

@section('content')
<div class="card text-white" style="height: 200px; overflow: hidden;">
	<div class="card-content">
		<img class="card-img img-fluid" src="https://www.giving.sg/image/logo?img_id=3261459" alt="Card image" style="margin-top: -180px;">
		<div class="card-img-overlay overlay-blue">
			<h1 class="text-white"><strong>Klinik kami siap membantu anda</strong></h1>
      <p class="card-text" style="width: 70%;">Lebih dari 50 klinik tersedia untuk anda</p>
		</div>
	</div>
</div>

  @foreach($clinics->chunk(4) as $clinicGroup)
    @component('components.carousel-clinic', [
      'clinics' => $clinicGroup
    ]) @endcomponent
  @endforeach
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
