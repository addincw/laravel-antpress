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
                <div class="text-center">
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="la la-facebook"></span></a>
                    <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="la la-twitter"></span></a>
                    <a href="#" class="btn btn-social-icon mb-1 btn-outline-linkedin"><span class="la la-linkedin font-medium-4"></span></a>
                </div>
            </div>
        </div>
    </div>
  @endforeach
</section>
