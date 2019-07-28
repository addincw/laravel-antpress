<section class="download">
  <div class="wrapper"> <!-- If Needed Left and Right Padding in 'md' and 'lg' screen means use container class -->
    <div class="row" style="margin: 0px;">
      <div class="card-download">
        <div class="row">
          <div class="col-md-8">
            <h3>Download Sekarang</h3>
            <p>Lebih update dengan menggunakan aplikasi kami.</p>
            <div class="download-image mt-3">
              <img src="{{ asset('img/google.png') }}" alt="">
            </div>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('img/download-i.png') }}" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer class="footer-kwtix">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-3">
        <div class="footer last-photos">
          <h3>Last Gallery</h3>
          <hr>
          <div class="row">
              @foreach($recentGalleries as $gallery)
              <div class="col-4">
                  <img src="{{ $gallery->file_url }}" alt="image {{ $gallery->title }}" class="img-fluid mb-2 rounded">
              </div>
              @endforeach
          </div>
      </div>
      </div>
      <div class="col-md-5">
        <div class="footer">
          <h3>{{ $profile->title }}</h3>
          <p>{{ $profile->description }}</p>
          <div class="inform mt-3">
            <div class="row">
              <div class="col-1">
                <i class='ft-map-pin'></i>
              </div>
              <div class="col">
                <p>{{ $profile->address }}</p>
                </div>
              </div>
            </div>
            <div class="inform">
              <div class="row">
                <div class="col-1">
                  <i class='ft-phone'></i>
                </div>
                <div class="col">
                  <p>{{ $profile->phone }}</p>
                </div>
              </div>
            </div>
            <div class="inform">
              <div class="row">
                <div class="col-1">
                  <i class='ft-mail'></i>
                </div>
                <div class="col">
                  <p>{{ $profile->email }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="maps-src">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.595040113829!2d112.75355801487572!3d-7.2868305736413514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbb5e5847b75%3A0xe6d3541d56199378!2sJl.+Kalibokor%2C+Gubeng%2C+Kota+SBY%2C+Jawa+Timur!5e0!3m2!1sid!2sid!4v1556872918017!5m2!1sid!2sid" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
