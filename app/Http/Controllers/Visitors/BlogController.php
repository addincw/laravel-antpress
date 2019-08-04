<?php
namespace App\Http\Controllers\Visitors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Contents\StoreContentComment;

use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Contents\ContentCategory;
use App\Models\Profile;
use App\Models\Testimoni;

class BlogController extends Controller
{
  private $route = '/blog';
  private $routeView = 'pages.visitors.blog';
  private $params = [];

  public function __construct ()
  {
    $this->params['route'] = $this->route;
    // testimoni
    $this->params['testimonies'] = Testimoni::all();

    // profile
    $this->params['profile'] = Profile::first();

    // content files: type image order by created at
    $this->params['recentGalleries'] = ContentFile::where('file_type', 'like', 'image%')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(9)->get();
  }
  public function index (Request $request)
  {
    $selectedCategory = null;
    $blogs = Content::query()->where('is_published', true)
                             ->where('type', 'blog')
                             ->orderBy('created_at', 'desc');

    if (!empty($request->category_id)) {
      $selectedCategory = $request->category_id;
      $blogs = $blogs->where('content_Category_id', $selectedCategory);
    }

    $this->params['selectedCategory'] = $selectedCategory;

    $this->params['blogTiles'] = Content::where('is_published', true)
                             ->where('type', 'blog')
                             ->orderBy('created_at', 'desc')
                             ->limit(3)
                             ->get();

    $this->params['blogCategories'] = ContentCategory::where('is_delete', true)->get();

    $this->params['blogs'] = $blogs->paginate(10);

    return view($this->routeView . '.index', $this->params);
  }
  public function show ($slug)
  {
    $content = Content::where('slug', $slug)->first();
    $this->params['content'] = $content;
    $this->params['blogs'] = Content::query()->where('is_published', true)
                             ->where('type', 'blog')
                             ->where('slug', '!=', $content->slug)
                             ->where('content_category_id', $content->content_category_id)
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

    if(empty($this->params['content'])){
      return redirect($this->route);
    }

    return view($this->routeView . '._slug', $this->params);
  }
  public function storeComment($slug, storeContentComment $request)
  {
    $validated = (object) $request->validated();
    $content = Content::where('slug', $slug)->first();

    try {
      $content->comments()->create([
        'name' => $validated->name,
        'email' => $validated->email,
        'body' => $validated->body,
      ]);

      $request->session()->flash('status', [
        'code' => 'success',
        'message' => 'Komentar berhasil di tambahkan',
      ]);
    } catch (\Exception $e) {
      $request->session()->flash('status', [
        'code' => 'error',
        'message' => 'Komentar gagal di tambahkan',
      ]);
    }

    return redirect($this->route . '/' . $slug);
  }
}
