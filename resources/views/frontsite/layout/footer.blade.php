<section class="download">
  <div class="wrapper"> <!-- If Needed Left and Right Padding in 'md' and 'lg' screen means use container class -->
    <div class="row" style="margin: 0px;">
      <div class="card-download">
        <div class="row">
          <div class="col-md-8">
            <h3>Download Sekarang</h3>
            <p>Lebih update dengan menggunakan aplikasi kami.</p>
            <div class="download-btn-image mt-3">
              <img src="{{ asset('img/google.png') }}" alt="">
            </div>
          </div>
          <div class="col-md-4">
            <img class="download-image" src="{{ asset('img/download-i.png') }}" />
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

            <div class="inform mt-1">
              <div class="row">
                <div class="col-1">
                  <i class='ft-phone'></i>
                </div>
                <div class="col">
                  <p>{{ $profile->phone }}</p>
                </div>
              </div>
            </div>

            <div class="inform mt-1">
              <div class="row">
                <div class="col-1">
                  <i class='ft-mail'></i>
                </div>
                <div class="col">
                  <p>{{ $profile->email }}</p>
                </div>
              </div>
            </div>

            <div class="inform mt-5">
              <h3>Social Media</h3>

              <div class="row mt-2">
                <div class="nav-item">
                  <a class="nav-link" href="{{ $profile->facebook }}">
                    <i class="ficon ft-facebook"></i>
                  </a>
                </div>
                <div class="nav-item">
                  <a class="nav-link" href="{{ $profile->twitter }}">
                    <i class="ficon ft-twitter"></i>
                  </a>
                </div>
                <div class="nav-item">
                  <a class="nav-link" href="{{ $profile->instagram }}">
                    <i class="ficon ft-instagram"></i>
                  </a>
                </div>
                <div class="nav-item">
                  <a class="nav-link" href="{{ $profile->whatsapp }}">
                    <i class="ficon la la-whatsapp "></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="maps-src">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253292.42716058585!2d112.57259700215688!3d-7.27559793655625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3027a76e352be40!2sSurabaya%2C%20Surabaya%20City%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1648529664651!5m2!1sen!2sid" 
              width="100%" 
              height="450" 
              frameborder="0" 
              style="border:0" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
            >
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
