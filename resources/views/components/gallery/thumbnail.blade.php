<?php 
    $route = $route ? $route : NULL;
    $tabs = $tabs ? $tabs : [];
    $selectedTab = $selectedTab ? $selectedTab : NULL;
    $tabLink = !empty($tabLink) ? $tabLink : $route . '?type=';
    $selectedContent = !empty($selectedContent) ? $selectedContent : NULL;
    $galeries = $galeries ? $galeries : [];
    $useFilter = !empty($useFilter) ? $useFilter : 'true';
    $isEditable = !empty($isEditable) ? $isEditable : 'true';
?>

<!--Search Navbar-->
<div id="search-nav">
    <ul class="nav nav-inline">
    @foreach($tabs as $tabKey => $tab)
    <li class="nav-item">
        <a
        class="nav-link @if($tabKey === $selectedTab) active @endif"
        href="{{ url($tabLink . $tabKey) }}"
        >
        <i class="la la-file-image-o"></i> {{ $tab['name'] }}
        </a>
    </li>
    @endforeach
    </ul>
</div>
<!--/ Search Navbar-->

@if($useFilter === 'true')
<div class="form-group mt-3 mb-0">
    <label for="">Tampilkan galeri berdasarkan konten...</label>
    <select class="select2 form-control form-control-xl input xl" name="content_id">
    @if(!empty($selectedContent))
    <option value="{{ $selectedContent->id }}" selected="selected">{{ $selectedContent->title }}</option>
    @endif
    </select>
</div>
@endif

<!--Search Result-->
<div id="search-results" class="pt-3">
    <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
    @foreach($galeries->chunk(4) as $chunkGaleries)
    <div class="card-deck-wrapper">
        <div class="card-deck mb-3">
        @foreach($chunkGaleries as $gallery)

            @if($gallery->file_type === 'video')
            <div class="card" style="border: 1px solid rgba(62, 57, 107, 0.19) !important;">
            <div class="card-content">
                <div class="card-header">
                <h4 class="card-title">{{ $gallery->title }}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                    <li>
                        <a class="video__button--edit info" data-id="{{ $gallery->id }}"><i class="ft-edit"></i></a>
                    </li>
                    <li>
                        <a class="deleteBtn danger" href="{{ url($route . '/' . $gallery->id) }}"><i class="ft-trash"></i></a>
                    </li>
                    </ul>
                </div>
                </div>
                <div class="embed-responsive embed-responsive-item embed-responsive-16by9">
                <iframe class="img-thumbnail" src="{{ $gallery->file }}"  allowfullscreen=""> </iframe>
                </div>
            </div>
            </div>
            @else
            <figure class="card card-img-top border-grey border-lighten-2" itemprop="associatedMedia"
            itemscope itemtype="http://schema.org/ImageObject" style="height: 200px; overflow: hidden;">
            <a href="{{ asset('storage/' . $gallery->file) }}" itemprop="contentUrl" data-size="480x360">
                <img id="{{ $gallery->id }}" class="gallery-thumbnail card-img-top" src="{{ asset('storage/' . $gallery->file) }}"
                itemprop="thumbnail" height="100%" />
            </a>
            @if(empty($gallery->title))
            <div class="card-body px-0">
                <p>
                <span class="text-bold-600">{{ $gallery->title }}</span>
                </p>
                <p class="card-text">{{ $gallery->description }}</p>
            </div>
            @endif
            </figure>
            @endif
        @endforeach
        </div>
    </div>
    @endforeach
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
            @if($isEditable === 'true')
            <button class="pswp__button pswp__button--delete" title="Delete"> <i class="ft-trash text-white"></i> </button>
            <button class="pswp__button pswp__button--edit" title="Edit"> <i class="ft-edit text-white"></i> </button>
            @endif
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

@php
$query['type_file'] = $selectedTab;

if($selectedContent) {
    $query['content_id'] = $selectedContent->id;
}

@endphp
{!! $galeries->appends($query)->links() !!}

<form class="form-delete" method="post" style="display: none;">
  {{ csrf_field() }}
  @method('DELETE')
</form>

<!-- css -->
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/forms/selects/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/pages/gallery.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/extensions/sweetalert.css') }}">
<style type="text/css">
.pswp__button--edit, .pswp__button--delete{ background: none !important; }
</style>
@endpush

<!-- js -->
@push('js')
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}"
type="text/javascript"></script>
<script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
var baseUrl = "{{ url('/') }}";
var targetUrl = "{{ url('admin/konten/galeri') }}";

$(document).ready(function () {

  initPhotoSwipeFromDOM('.my-gallery');

  $("select[name='content_id']").select2({
    ajax: {
      url: `${baseUrl}/api/content/getAll`,
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
      "type": "{{ $selectedTab }}",
      "content_id": $(this).val()
    }

    window.location.href = `${targetUrl}?${$.param(query)}`
  })

  $(".pswp__button--edit, .video__button--edit").on('click', function () {
    var videoExt = ['video', 'promo-video']
    window.location.href = videoExt.includes('{{ $selectedTab }}') ? 
                                `${targetUrl}/video/${$(this).data('id')}/edit` : `${targetUrl}/${$(this).data('id')}/edit`
  })

  $('.deleteBtn, .pswp__button--delete').on('click', function(){
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
        //for delete form by content_file_id
        $(".pswp__button--delete").attr('href', `${targetUrl}/${eTarget.id}`)

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
</script>
@endpush