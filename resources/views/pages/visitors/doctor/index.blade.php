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

<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header card-title">
				<i class="ft-search mr-1"></i> Filter Dokter	
			</div>

			<form method="get">
		   
		        <div class="card-body">
					<fieldset>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon3"><i class="ft-briefcase"></i></span>
							</div>
							<input type="text" class="form-control" name="doctor_specialist" placeholder="Specialisasi Dokter" aria-describedby="basic-addon3" value="{{ $filterSpecialist }}">
						</div>
					</fieldset>

					<fieldset>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon3"><i class="la la-user"></i></span>
							</div>
							<input type="text" class="form-control" name="doctor_name" placeholder="Nama Dokter" aria-describedby="basic-addon3" value="{{ $filterName }}">
						</div>
					</fieldset>
		        </div>

		        <div class="card-footer">
		        	<button type="submit" class="btn btn-primary btn-block" name="submit" value="with_filter"> Cari </button>
		        	<button type="submit" class="btn btn-block" name="submit" value="without_filter"> Reset </button>
		        </div>

			</form>
	    </div>
	</div>

	<div class="col-md-9">
		@foreach($doctors->chunk(4) as $doctorGroup)
			@component('components.carousel-doctor', ['doctors' => $doctorGroup]) @endcomponent
		@endforeach	
	</div>
</div>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection
