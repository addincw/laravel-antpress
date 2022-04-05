<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Frontsite\MainController;

use App\Http\Requests\Contents\StoreContentFile;

use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Contents\ContentCategory;
use App\Models\Contents\ContentTag;

class GalleryController extends MainController
{
    protected $route = 'galeri';
    protected $routeView = 'frontsite.gallery';

    public function __construct ()
    {
      parent::__construct();
      $this->modelContent = new Content();
      $this->model = new ContentFile();

      $this->params['route'] = $this->route;
      $this->params['routeView'] = $this->routeView;
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
