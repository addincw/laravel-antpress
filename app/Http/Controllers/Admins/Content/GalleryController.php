<?php

namespace App\Http\Controllers\Admins\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contents\StoreContentFile;
use App\Models\Contents\Content;
use App\Models\Contents\ContentFile;
use App\Models\Contents\ContentCategory;
use App\Models\Contents\ContentTag;

class GalleryController extends Controller
{
    private $route = 'admin/konten/galeri';
    private $routeView = 'pages.admins.contents.gallery';
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

    private $params = [];

    public function __construct ()
    {
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
      $query = $this->model->query();
      $selectedContent = $request->content_id ? $request->content_id : NUll;
      $selectedType = $request->type ? $request->type : 'image';
      $type = $this->types[$selectedType];
      $content = $this->modelContent->find($selectedContent);

      try {
        if ( in_array($selectedType, ['banner', 'promo-video']) ) {
          $query = $query->where('is_highlight', true);
        }

        if ( !empty($selectedContent) ) {
          $query = $query->where('content_id', $selectedContent);
        }

        $query = $query->where('file_type', 'like', $type['ext']."%");
        $galeries = $query->paginate(12);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'tidak dapat menampilkan galeri ' . $type['name'],
        ]);
        return redirect()->back();
      }

      $this->params['contents'] = $this->modelContent->get();
      $this->params['selectedType'] = $selectedType;
      $this->params['selectedContent'] = $content;
      $this->params['types'] = $this->types;
      $this->params['galeries'] = $galeries;
      return view($this->routeView . '.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->params['contents'] = $this->modelContent->get();
      return view($this->routeView . '.create', $this->params);
    }

    public function createSingle()
    {
      $this->params['contents'] = $this->modelContent->get();
      return view($this->routeView . '.create-single', $this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentFile $request)
    {
      $validated = (object) $request->validated();

      try {
        DB::beginTransaction();

        $content = $this->modelContent->find($validated->content_id);

        if ($request->hasFile('file')) {
          $uploaded = [];
          foreach ($request->file('file') as $keyFile => $file) {
            $uploaded[$keyFile] = $file->store('gallery', 'public');
            ContentFile::create([
              'file' => $uploaded[$keyFile],
              'file_type' => $file->getMimeType(),
              'is_highlight' => false,
              'content_id' => $content->id,
            ]);
          }
        }

        DB::commit();
        session()->put('status', [
          'code' => 'success',
          'message' => 'file berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('file')) {
          if ($uploaded) {
            foreach ($uploaded as $key => $value) {
              \Storage::disk('public')->delete($value);
            }
          }
        }
        session()->put('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan file : ' . $e->getMessage(),
        ]);

        return response()->json($e->getMessage(), 500);
      }

      return response()->json([], 200);
    }

    public function storeSingle(StoreContentFile $request)
    {
      $validated = (object) $request->validated();
      $file = null;
      $fileType = 'image';

      try {
        DB::beginTransaction();
        if ($request->hasFile('file')) {
          $file = $request->file('file')->store('gallery', 'public');
          $fileType = $request->file('file')->getMimeType();
        }

        $this->model->create([
          'title' => $request->title,
          'description' => $request->description,
          'file' => $file,
          'file_type' => $fileType,
          'is_highlight' => $request->is_highlight === 'on' ? 1 : 0,
          'content_id' => $validated->content_id,
        ]);

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'galeri berhasil di simpan',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('file')) {
          \Storage::disk('public')->delete($file);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan galeri : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->params['content'] = $this->model->find($id);
      return view($this->routeView . '.show', $this->params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['contents'] = $this->modelContent->get();
        $this->params['gallery'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContentFile $request, $id)
    {
      $validated = (object) $request->validated();
      $gallery = $this->model->where('id', $id)->first();
      $file = $gallery->file;
      $fileType = $gallery->file_type;

      try {
        DB::beginTransaction();
        if ($request->hasFile('file')) {
          if ($file) {
            \Storage::disk('public')->delete($gallery->file);
          }

          $file = $request->file('file')->store('gallery', 'public');
          $fileType = $request->file('file')->getMimeType();
        }

        $gallery->update([
          'title' => $request->title,
          'description' => $request->description,
          'file' => $file,
          'file_type' => $fileType,
          'is_highlight' => $request->is_highlight === 'on' ? 1 : 0,
          'content_id' => $validated->content_id,
        ]);

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'galeri berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('file')) {
          \Storage::disk('public')->delete($file);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui galeri : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $content = $this->model->find($id);
      $name = $content->title;

      if (!$content->is_delete) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'menghapus data tidak diizinkan',
        ]);

        return redirect()->back();
      }

      try {
        \Storage::disk('public')->delete($content->thumbnail);
        \Storage::disk('public')->delete($content->creator_image);
        if ($content->tags()) { $content->tags()->delete(); }
        $content->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Konten dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus konten '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
