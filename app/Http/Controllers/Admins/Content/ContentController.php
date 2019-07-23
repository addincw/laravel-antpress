<?php

namespace App\Http\Controllers\Admins\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contents\StoreContent;
use App\Models\Contents\Content;
use App\Models\Contents\ContentCategory;
use App\Models\Contents\ContentTag;

class ContentController extends Controller
{
    private $route = 'admin/konten/konten';
    private $routeView = 'pages.admins.contents.content';
    private $params = [];

    public function __construct ()
    {
      $this->model = new Content();
      $this->params['route'] = $this->route;
      $this->params['routeView'] = $this->routeView;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->params['contents'] = $this->model->with(['category'])->get();
      return view($this->routeView . '.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->params['categories'] = ContentCategory::all();
      return view($this->routeView . '.create', $this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContent $request)
    {
      $validated = (object) $request->validated();
      $thumbnail = null;
      $creator_image = null;

      try {
        DB::beginTransaction();
        if ($request->hasFile('thumbnail')) {
          $thumbnail = $request->file('thumbnail')->store('content', 'public');
        }

        if ($request->hasFile('creator_image')) {
          $creator_image = $request->file('creator_image')->store('content', 'public');
        }

        $content = $this->model->create([
          'title' => $validated->title,
          'slug' => str_replace(' ', '-', $validated->title) . '-' . rand(10,100),
          'description' => $validated->description,
          'thumbnail' => $thumbnail,
          'creator_image' => $creator_image,
          'creator_name' => $request->creator_name,
          'creator_title' => $request->creator_title,
          'is_published' => $request->is_published === 'on' ? 1 : 0,
          'content_category_id' => $validated->category
        ]);

        if (!empty($request->tags)) {
          foreach ($request->tags as $tagId) {
            ContentTag::create([
              'content_id' => $content->id,
              'tag_id' => $tagId
            ]);
          }
        }

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Konten berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('thumbnail')) {
          \Storage::disk('public')->delete($thumbnail);
        }

        if ($request->hasFile('creator_image')) {
          \Storage::disk('public')->delete($creator_image);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan konten : ' . $e->getMessage(),
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
        $this->params['categories'] = ContentCategory::all();
        $this->params['content'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContent $request, $id)
    {
      $validated = (object) $request->validated();
      $content = $this->model->where('id', $id)->first();
      $thumbnail = $content->thumbnail;
      $creator_image = $content->creator_image;

      try {
        DB::beginTransaction();
        if ($request->hasFile('thumbnail')) {
          if ($thumbnail) {
            \Storage::disk('public')->delete($content->thumbnail);
          }

          $thumbnail = $request->file('thumbnail')->store('content', 'public');
        }
        if ($request->hasFile('creator_image')) {
          if ($creator_image) {
            \Storage::disk('public')->delete($content->creator_image);
          }

          $creator_image = $request->file('creator_image')->store('content', 'public');
        }

        $content->update([
          'title' => $validated->title,
          'slug' => str_replace(' ', '-', $validated->title) . '-' . rand(10,100),
          'description' => $validated->description,
          'thumbnail' => $thumbnail,
          'creator_image' => $creator_image,
          'creator_name' => $request->creator_name,
          'creator_title' => $request->creator_title,
          'is_published' => $request->is_published === 'on' ? 1 : 0,
          'content_category_id' => $validated->category
        ]);

        if (!empty($request->tags)) {
          if (!empty($content->tags)) { $content->tags()->delete(); }

          foreach ($request->tags as $tagId) {
            ContentTag::create([
              'content_id' => $content->id,
              'tag_id' => $tagId
            ]);
          }
        }

        DB::commit();
        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'konten berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        if ($request->hasFile('thumbnail')) {
          \Storage::disk('public')->delete($thumbnail);
        }

        if ($request->hasFile('creator_image')) {
          \Storage::disk('public')->delete($creator_image);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui konten : ' . $e->getMessage(),
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
