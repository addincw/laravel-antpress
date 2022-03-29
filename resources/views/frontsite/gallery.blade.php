@extends('frontsite.layout.main')
@section('content')
<h2 class="mb-2"><strong>Galeri</strong></h2>
<div class="card">
  <div class="card-body">
    <!--Search Navbar-->
    <div id="search-nav">
      <ul class="nav nav-inline">
        @foreach($categories as $category)
        <li class="nav-item">
          <a
            class="nav-link @if($category->id == $selectedCategory) active @endif"
            href="{{ url($route . '?category=' . $category->id) }}"
          >
            <i class="la la-file-image-o"></i>{{ $category->title }}
          </a>
        </li>
        @endforeach
      </ul>
    </div>
    <!--/ Search Navbar-->

    <div class="form-group mt-3 mb-0">
      <label for="">Cari Kegiatan</label>
      <select class="select2 form-control form-control-xl input xl" name="content_id">
        @if(!empty($selectedContent))
        <option value="{{ $selectedContent->id }}" selected="selected">{{ $selectedContent->title }}</option>
        @endif
      </select>
    </div>

    <!--Search Result-->
    <div id="search-results" class="pt-3">
      <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
        @foreach($galeries->chunk(4) as $chunkGaleries)
        <div class="card-deck-wrapper">
          <div class="card-deck mb-3">
            @foreach($chunkGaleries as $gallery)
            <?php 
              $defaultWidth = '100%';
              $thumbnailLink = asset('storage/' . $gallery->file);
              $thumbnailUrl = asset('storage/' . $gallery->file);
              
              if($gallery->file_type === 'video') {
                $defaultWidth = '480px';
                $videoId = Illuminate\Support\Str::after($gallery->file, 'embed/');

                $thumbnailLink = $gallery->file;
                $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/0.jpg";
              }
            ?>
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject" style="height: 360px; overflow: hidden; position: relative">
              <a href="{{ $thumbnailLink }}" itemprop="contentUrl" data-size="480x360">
                <img id="{{ $gallery->id }}" class="gallery-thumbnail card-img-top" src="{{ $thumbnailUrl }}"
                itemprop="thumbnail" height="100%"  style="max-width: {{ $defaultWidth }}" />
              </a>
              @if(empty($gallery->title))
              <div class="card-body px-0">
                <p>
                  <span class="text-bold-600">{{ $gallery->title }}</span>
                </p>
                <p class="card-text">{{ $gallery->description }}</p>
              </div>
              @endif
              @if($gallery->file_type === 'video')
              <div class="overlay-video">
                <div class="overlay-video__icon-container">
                  <i class="overlay-video__icon la la-youtube-play"></i>
                </div>
              </div>
              @endif
            </figure>
            @endforeach
          </div>
        </div>
        @endforeach
      </div>

      <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel1">Preview Video</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <iframe class="img-thumbnail" width="100%" allowfullscreen=""> </iframe>
            </div>
          </div>
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
              <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
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
  <div class="card-footer">
    @php
    $query['category'] = [$selectedCategory];

    if($selectedContent) {
      $query['content_id'] = [$selectedContent->id];
    }
    @endphp
    {!! $galeries->appends($query)->links() !!}
  </div>
</div>
@endsection

@section('footer')
  @include('frontsite.layout.footer-complete')
  @parent
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/gallery.css') }}">
<style>
  .overlay-video{
    position: absolute; 
    top: 0px; 
    left: 0px; 
    width: 480px; 
    height: 360px; 
    background: #00000087;
  }
  @media only screen and (max-width: 425px) {
    .overlay-video{
      width: 290px;
      height: 217px; 
    }
  }
  .overlay-video__icon-container{
    position: absolute; 
    top: 50%; 
    left: 50%;
  }
  .overlay-video__icon{
    color: white; 
    font-size: 52px !important; 
    transform: translate(-25px, -15px); 
    cursor: pointer;
  }
  .img-thumbnail{
    height: 70vh;
  }
</style>
@endsection

@section('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}"
type="text/javascript"></script>

<script type="text/javascript">
var baseUrl = "{{ url('/') }}";
var currentUrl = "{{ url($route) }}";

var initPhotoSwipeFromDOM = function(gallerySelector) {

  // parse slide data (url, title, size ...) from DOM elements
  // (children of gallerySelector)
  var parseThumbnailElements = function(el) {
    var thumbElements = el.childNodes,
    numNodes = thumbElements.length,
    items = [],
    figureEl,
    linkEl,
    size,
    item;

    for(var i = 0; i < numNodes; i++) {

      figureEl = thumbElements[i]; // <figure> element

        // include only element nodes
        if(figureEl.nodeType !== 1) {
          continue;
        }

        linkEl = figureEl.children[0]; // <a> element

        size = linkEl.getAttribute('data-size').split('x');

        // create slide object
        item = {
          src: linkEl.getAttribute('href'),
          w: parseInt(size[0], 10),
          h: parseInt(size[1], 10)
        };



        if(figureEl.children.length > 1) {
          // <figcaption> content
          item.title = figureEl.children[1].innerHTML;
        }

        if(linkEl.children.length > 0) {
          // <img> thumbnail element, retrieving thumbnail url
          item.msrc = linkEl.children[0].getAttribute('src');
        }

        item.el = figureEl; // save link to element for getThumbBoundsFn
        items.push(item);
      }

      return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
      return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
      e = e || window.event;
      e.preventDefault ? e.preventDefault() : e.returnValue = false;

      var eTarget = e.target || e.srcElement;

      //for edit form by content_file_id
      $(".pswp__button--edit").data('id', eTarget.id)

      // find root element of slide
      var clickedListItem = closest(eTarget, function(el) {
        return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
      });

      if(!clickedListItem) {
        return;
      }

      // find index of clicked item by looping through all child nodes
      // alternatively, you may define index via data- attribute
      var clickedGallery = clickedListItem.parentNode,
      childNodes = clickedListItem.parentNode.childNodes,
      numChildNodes = childNodes.length,
      nodeIndex = 0,
      index;

      var thumbnailElement = parseThumbnailElements(clickedGallery);
      if(thumbnailElement[0].src.includes("embed")) {
        $('#modalVideo').modal('show');
        $('#modalVideo .modal-body .img-thumbnail').attr('src', thumbnailElement[0].src);
        return;
      }

      for (var i = 0; i < numChildNodes; i++) {
        if(childNodes[i].nodeType !== 1) {
          continue;
        }

        if(childNodes[i] === clickedListItem) {
          index = nodeIndex;
          break;
        }
        nodeIndex++;
      }

      if(index >= 0) {
        // open PhotoSwipe if valid index found
        openPhotoSwipe( index, clickedGallery );
      }
      return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
      var hash = window.location.hash.substring(1),
      params = {};

      if(hash.length < 5) {
        return params;
      }

      var vars = hash.split('&');
      for (var i = 0; i < vars.length; i++) {
        if(!vars[i]) {
          continue;
        }
        var pair = vars[i].split('=');
        if(pair.length < 2) {
          continue;
        }
        params[pair[0]] = pair[1];
      }

      if(params.gid) {
        params.gid = parseInt(params.gid, 10);
      }

      return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
      var pswpElement = document.querySelectorAll('.pswp')[0],
      gallery,
      options,
      items;

      items = parseThumbnailElements(galleryElement);
      // define options (if needed)
      options = {

        // define gallery index (for URL)
        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

        getThumbBoundsFn: function(index) {
          // See Options -> getThumbBoundsFn section of documentation for more info
          var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
          pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
          rect = thumbnail.getBoundingClientRect();

          return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
        }

      };

      // PhotoSwipe opened from URL
      if(fromURL) {
        if(options.galleryPIDs) {
          // parse real index when custom PIDs are used
          // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
          for(var j = 0; j < items.length; j++) {
            if(items[j].pid == index) {
              options.index = j;
              break;
            }
          }
        } else {
          // in URL indexes start from 1
          options.index = parseInt(index, 10) - 1;
        }
      } else {
        options.index = parseInt(index, 10);
      }

      // exit if index not found
      if( isNaN(options.index) ) {
        return;
      }

      if(disableAnimation) {
        options.showAnimationDuration = 0;
      }

      // Pass data to PhotoSwipe and initialize it
      gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
      gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
      galleryElements[i].setAttribute('data-pswp-uid', i+1);
      galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
      openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
}

initPhotoSwipeFromDOM('.my-gallery');

$("select[name='content_id']").select2({
  ajax: {
    url: `${baseUrl}/api/content/all`,
    data: function (params) {
      var query = { searchKey: params.term }
      return query;
    },
    processResults: function (data) {
      return {
        results: data.results.map((content) => {
          content.text = content.title
          return content
        })
      }
    },

  }
})

$("select[name='content_id']").on('change', function () {
  let query = {
    "category": "{{ $selectedCategory }}",
    "content_id": $(this).val()
  }

  window.location.href = `${currentUrl}?${$.param(query)}`
})
</script>
@endsection
