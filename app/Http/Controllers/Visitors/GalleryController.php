<?php

namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Requests\Contents\StoreContentFile;

use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Contents\ContentCategory;
use App\Models\Contents\ContentTag;
use App\Models\Profile;
use App\Models\Testimoni;

class GalleryController extends Controller
{
    private $route = 'galeri';
    private $routeView = 'pages.visitors.gallery';
    private $params = [];

    public function __construct ()
    {
      $this->modelContent = new Content();
      $this->model = new ContentFile();

      $this->params['route'] = $this->route;
      $this->params['routeView'] = $this->routeView;
      // testimoni
      $this->params['testimonies'] = Testimoni::all();

      // profile
      $this->params['profile'] = Profile::first();

      // content files: type image order by created at
      $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                         ->orderBy('created_at', 'desc')
                                         ->limit(9);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $query = $this->model->query()->join('contents', 'contents.id', 'content_files.content_id');
      $selectedContent = $request->content_id ? $request->content_id : NUll;
      $selectedCategory = $request->category ? $request->category : null;

      $category = ContentCategory::find($selectedCategory);
      $content = $this->modelContent->find($selectedContent);

      try {
        if ( $selectedCategory ) {
          $query = $query->where('content_category_id', $selectedCategory);
        }

        if ( !empty($selectedContent) ) {
          $query = $query->where('content_files.content_id', $selectedContent);
        }

        // $query = $query->where('file_type', 'like', $type['ext']."%");
        $galeries = $query->paginate(12);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'tidak dapat menampilkan galeri ' . $category->name,
        ]);
        return redirect()->back();
      }

      $this->params['contents'] = $this->modelContent->get();
      $this->params['selectedCategory'] = $selectedCategory;
      $this->params['selectedContent'] = $content;
      $this->params['categories'] = ContentCategory::all();
      $this->params['galeries'] = $galeries;
      return view($this->routeView, $this->params);
    }
}
