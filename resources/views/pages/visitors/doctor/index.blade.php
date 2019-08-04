@extends('layouts.visitor.main')

@section('content')
<div class="card text-white" style="height: 200px; overflow: hidden;">
	<div class="card-content">
		<img class="card-img img-fluid" src="https://learnpolishtoday.com/blog_images/how-to-talk-about-medical-stuff-basic-polish-words-and-hospital-things-ERzk800x300.jpg" alt="Card image">
		<div class="card-img-overlay overlay-blue">
			<h1 class="text-white"><strong>Dokter Terbaik Kami</strong></h1>
      <p class="card-text" style="width: 70%;">Lebih dari {{ $doctors->count() }} dokter dari berbagai macam bidang siap membantu anda</p>
		</div>
	</div>
</div>

  @foreach($doctors->chunk(4) as $doctorGroup)
    @component('components.carousel-doctor', ['doctors' => $doctorGroup]) @endcomponent
  @endforeach
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
