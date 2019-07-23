@extends('layouts.admin.main')

@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Galeri
      <a class="btn btn-primary white pull-right" href="{{ url($route . '/create') }}">Tambah Galeri <i class="ft-plus"></i> </a>
    </h4>
  </div>
  <div class="card-body">
    <!--Search Navbar-->
    <div id="search-nav">
      <ul class="nav nav-inline">
        <li class="nav-item">
          <a class="nav-link" href="search-images.html"><i class="la la-file-image-o"></i> Banner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="search-images.html"><i class="la la-file-image-o"></i> Images</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search-videos.html"><i class="la la-file-video-o"></i> Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search-videos.html"><i class="la la-file-video-o"></i> Promo Video</a>
        </li>
      </ul>
    </div>
    <!--/ Search Navbar-->
    <!--Search Result-->
    <div id="search-results" class="pt-3">
      <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
        <div class="card-deck-wrapper">
          <div class="card-deck">
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/1.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/1.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Maecenas</span> sollicitudin
                  <span class="font-small-2 text-muted float-right">720 x 600</span>
                </p>
                <p class="card-text">Nulla ac vulputate mauris. Nam tincidunt odio purus.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/2.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/2.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Aliquam </span> vel nib
                  <span class="font-small-2 text-muted float-right">480 x 360</span>
                </p>
                <p class="card-text">Phasellus vitae aliquam felis, et bibendum orci.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/3.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/3.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Molestie </span> accumsan
                  <span class="font-small-2 text-muted float-right">480 x 360</span>
                </p>
                <p class="card-text">Maecenas commodo odio sed nibh viverra vestibulum.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/4.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/4.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Nam eu </span> efficitur
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text">Donec porttitor massa vitae leo rutrum viverra.</p>
              </div>
            </figure>
          </div>
        </div>
        <div class="card-deck-wrapper">
          <div class="card-deck mt-1">
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/5.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/5.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Porttitor </span> donec
                  <span class="font-small-2 text-muted float-right">560 x 360</span>
                </p>
                <p class="card-text">Sed suscipit velit vitae justo pharetra.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/6.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/6.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Velit et </span> interdum
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text"> Duis auctor velit et interdum maximus.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/7.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/7.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Natoque </span> efficitur
                  <span class="font-small-2 text-muted float-right">800 x 600</span>
                </p>
                <p class="card-text">Cum sociis natoque penatibus et magnis dis.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/8.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/8.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Pharetra </span> enim id
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text">Mauris imperdiet enim id urna pharetra.</p>
              </div>
            </figure>
          </div>
        </div>
        <div class="card-deck-wrapper">
          <div class="card-deck mt-1">
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/9.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/9.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Integer </span> fermentum
                  <span class="font-small-2 text-muted float-right">380 x 360</span>
                </p>
                <p class="card-text">Vel lacinia cursus, est dui tincidunt sem.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/10.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/10.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Donec congue </span> nec
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text">Morbi laoreet ultrices mi ut imperdiet.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/11.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/11.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Vivamus </span> eget
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text">Lorem ipsum dolor sit amet.</p>
              </div>
            </figure>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject">
              <a href="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/12.jpg') }}" itemprop="contentUrl" data-size="480x360">
                <img class="gallery-thumbnail card-img-top" src="{{ asset('theme/modern-admin-1.0/app-assets/images/gallery/12.jpg') }}"
                itemprop="thumbnail" alt="Image description" />
              </a>
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">Aenean </span> pharetra
                  <span class="font-small-2 text-muted float-right">500 x 360</span>
                </p>
                <p class="card-text">Ligula ornare velit porttitor viverra et a felis.</p>
              </div>
            </figure>
          </div>
        </div>
        <div class="text-center">
          <nav aria-label="Page navigation">
            <ul class="pagination pagination-separate pagination-round pagination-flat">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">« Prev</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item active"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">Next »</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Root element of PhotoSwipe. Must have class pswp. -->
      <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Background of PhotoSwipe.
       It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>
        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">
          <!-- Container that holds slides.
          PhotoSwipe keeps only 3 of them in the DOM to save memory.
          Don't modify these 3 pswp__item elements, data is added later on. -->
          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>
          <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
          <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
              <!--  Controls are self-explanatory. Order can be changed. -->
              <div class="pswp__counter"></div>
              <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
              <button class="pswp__button pswp__button--share" title="Share"></button>
              <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
              <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
              <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
              <!-- element will get class pswp__preloader-active when preloader is running -->
              <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
              <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>
          </div>
        </div>
      </div>
      <!--/ PhotoSwipe -->
    </div>
  </div>
</div>

<form class="form-delete" method="post" style="display: none;">
  {{ csrf_field() }}
  @method('DELETE')
</form>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/gallery.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/extensions/sweetalert.css') }}">
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('.deleteBtn').on('click', function(){
    swal({
            title: "Yakin menghapus data?",
            text: "Data yang sudah dihapus, tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            buttons: {
              cancel: {
                  text: "Tidak, Batalkan!",
                  value: null,
                  visible: true,
                  className: "btn-warning",
                  closeModal: true,
              },
              confirm: {
                  text: "Ya, Hapus sekarang!",
                  value: true,
                  visible: true,
                  className: "",
                  closeModal: false
              }
            }
        })
        .then((isConfirm) => {
            if (isConfirm) {
              let deleteLink = $(this).attr("href")
              $("form.form-delete").attr("action", deleteLink)
              $("form.form-delete").submit();
            }
            swal.close();
        });

    return false
  });
})
</script>
@endsection
