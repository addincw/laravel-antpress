<?php

namespace App\Http\Controllers\Api\Contents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contents\Content;
use App\Models\Contents\ContentCategory;
use App\Models\Contents\ContentComment;

use App\Http\Requests\Contents\storeContentComment;

class ContentController extends Controller
{
    private $response = [
      'message' => '',
      'data' => null
    ];

    public function __construct ()
    {
      $this->model = new Content();
    }
    public function getCategories ()
    {
      $this->response['data'] = ContentCategory::all();
      return response()->json($this->response, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
      $contents = $this->model;
      $where = "1=1";
      $response = [];

      if ($request->searchKey) {
        $where .= " and title like '%{$request->searchKey}%'";
      }

      try {
        $results = $contents->whereRaw($where)
                   ->get()
                   ->makeHidden(['created_at', 'updated_at']);

        $response['results'] = $results;
      } catch (\Exception $e) {
        return response(['message' => $e->getMessage()], 500);
      }

      return response()->json($response, 200);
    }

    public function index (Request $request)
    {

      $query = $this->model->query();

      $query = $query->where('type', 'blog')
                     ->where('is_published', true);

      // filter by category
      if ($request->category !== 'all'){
        $category = ContentCategory::where('slug', urldecode($request->category))->first();
        $query = $query->where('content_category_id', $category->id);
      }

      $contents = $query->with(['category:id,title'])
                        ->withCount('comments')
                        ->paginate(10);

      $response = array_merge($this->response, $contents->toArray());
      return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $where = "slug = '{$id}' or id = ".(int) $id."";

      try {
        $content = Content::whereRaw($where)->with([
            'files:id,content_id,title,description,file,file_type',
            'category:id,title',
            'tags',
          ])
          ->withCount('comments')
          ->first();

        if (!$content) {
          $this->response['message'] = 'data tidak ditemukan';
          return response()->json($this->response, 404);
        }

        $this->response['data'] = $content;
      } catch (\Exception $e) {
        $this->response['message'] = 'terjadi kesalahan server' . $e->getMessage();
        return response()->json($this->response, 500);
      }

      return response()->json($this->response, 200);
    }

    public function storeContentComment($content_id, storeContentComment $request)
    {
      $validated = (object) $request->validated();
      $content = $this->model->find($content_id);

      try {
        $content->comments()->create([
          'name' => $validated->name,
          'email' => $validated->email,
          'body' => $validated->body,
        ]);

        $this->response['message'] = 'Komentar berhasil di tambahkan';
      } catch (\Exception $e) {
        $this->response['message'] = 'Komentar gagal di tambahkan : ' . $e->getMessage();
        return response()->json($this->response, 500);
      }

      return response()->json($this->response, 200);
    }

    public function relatedContents ($content_id)
    {
      $content = $this->model->find($content_id);

      $relatedContents = Content::query()->where('is_published', true)
                             ->where('type', 'blog')
                             ->where('slug', '!=', $content->slug)
                             ->where('content_category_id', $content->content_category_id)
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->with(['category:id,title'])
                             ->withCount('comments')
                             ->get();

      $this->response['data'] = $relatedContents;

      return response()->json($this->response, 200);
    }

    public function commentsByContentId ($content_id)
    {
      $contents = ContentComment::where('content_id', $content_id)
                                ->paginate(10);

      $response = array_merge($this->response, $contents->toArray());
      return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
