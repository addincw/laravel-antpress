<?php

namespace App\Http\Controllers\Api\Contents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contents\Content;

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
      $contents = Content::where('type', 'blog')
                                ->where('is_published', true)
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
      $where = strpos($id, "-") ? "slug = '{$id}'" : "id = $id";

      try {
        $content = Content::whereRaw($where)->first();

        if (!$content) {
          $this->response['message'] = 'data tidak ditemukan';
          return response()->json($this->response, 404);
        }

        $this->response['data'] = $content;
      } catch (\Exception $e) {
        $this->response['message'] = 'terjadi kesalahan server';
        return response()->json($this->response, 500);
      }

      return response()->json($this->response, 200);
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
