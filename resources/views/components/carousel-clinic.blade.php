<section class="row mb-3 match-height">
  @foreach($clinics as $clinic)
    <div class="col-md-3">
      <div class="card" style="height: 100%;">
				<div class="card-content">
          <div style="max-height: 300px; overflow: hidden;">
            <img class="card-img-top img-fluid" src="{{ $clinic->thumbnail_url }}" alt="Card image cap" width="100%">
          </div>
					<div class="card-body">
						<h4 class="card-title">{{ $clinic->title }}</h4>
						<p class="card-text">
              {!! html_entity_decode(str_limit(strip_tags($clinic->description), 50)) !!}
              @if (strlen(strip_tags($clinic->description)) > 50)
                ...
              @endif
            </p>
					</div>
				</div>
        <div class="card-footer">
          <a href="{{ url('/layanan/' . $clinic->id) }}" class="btn btn-outline-primary">lihat lebih lanjut</a>
        </div>
			</div>
    </div>
  @endforeach
</section>
