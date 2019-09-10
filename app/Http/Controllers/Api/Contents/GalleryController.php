<?php

namespace App\Http\Controllers\Api\Contents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Contents\ContentFile;

class GalleryController extends Controller
{
    private $types = [
      'banner' => [
        'name' => 'Banner',
        'ext' => 'image'
      ],
      'image' => [
        'name' => 'Images',
        'ext' => 'image'
      ],
      'video' => [
        'name' => 'Videos',
        'ext' => 'video'
      ],
      'promo-video' => [
        'name' => 'Promo Video',
        'ext' => 'video'
      ],
    ];

    private $response = [
      'message' => '',
      'data' => null
    ];

    public function __construct ()
    {
      $this->model = new ContentFile();
    }

    public function getHighlightImage ()
    {
      try {
        $type = $this->types['banner'];
        
        $banner = $this->model->where('is_highlight', true)
                    ->where('file_type', 'like', $type['ext']."%")
                    ->get();

        $response['results'] = $banner;         

      } catch (\Exception $e) {
        return response(['message' => $e->getMessage()], 500);
      }

      return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
