<section class="row">
  @foreach($doctors as $doctor)
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card">
            <div class="text-center">
                <div class="card-body">
                    <img src="{{ $doctor->image_url }}" class="rounded-circle  height-150" alt="Card image">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $doctor->name }}</h4>
                    <h6 class="card-subtitle text-muted">{{ $doctor->specialist }}</h6>
                </div>
                <div class="card-footer">
                    <a href="{{ url('/dokter/' . $doctor->id) }}" class="btn btn-block btn-outline-primary"><span class="ft-user"></span> lihat profil</a>
                </div>
            </div>
        </div>
    </div>
  @endforeach
</section>
