<?php

namespace App\Http\Controllers\Backsite\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contents\StoreContentCategory;
use App\Models\Contents\ContentCategory;

class CategoryController extends Controller
{
    private $route = 'backsite/konten/kategori';
    private $routeView = 'backsite.contents.category';
    private $params = [];

    public function __construct ()
    {
      $this->model = new ContentCategory();
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
      $this->params['categories'] = $this->model->get();
      return view($this->routeView . '.index', $this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view($this->routeView . '.create', $this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentCategory $request)
    {
      $validated = (object) $request->validated();
      $thumbnail = null;

      try {
        if ($request->hasFile('thumbnail')) {
          $thumbnail = $request->file('thumbnail')->store('category', 'public');
        }

        $this->model->create([
          'title' => $validated->title,
          'slug' => str_replace(' ', '-', $validated->title) . '-' . rand(10,100),
          'description' => $validated->description,
          'thumbnail' => $thumbnail
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Kategori berhasil di tambahkan',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menyimpan category : ' . $e->getMessage(),
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->params['category'] = $this->model->find($id);
        return view($this->routeView . '.edit', $this->params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContentCategory $request, $id)
    {
      $validated = (object) $request->validated();
      $category = $this->model->where('id', $id)->first();
      $thumbnail = $category->thumbnail;

      try {
        if ($request->hasFile('thumbnail')) {
          if ($thumbnail) {
            \Storage::disk('public')->delete($category->thumbnail);
          }

          $thumbnail = $request->file('thumbnail')->store('category', 'public');
        }

        $category->update([
          'title' => $validated->title,
          'description' => $validated->description,
          'thumbnail' => $thumbnail
        ]);

        $request->session()->flash('status', [
          'code' => 'success',
          'message' => 'Kategori berhasil di perbarui',
        ]);
      } catch (\Exception $e) {
        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal memperbarui kategori : ' . $e->getMessage(),
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
      $category = $this->model->find($id);
      $name = $category->title;

      if (!$category->is_delete) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'menghapus data tidak diizinkan',
        ]);

        return redirect()->back();
      }

      try {
        \Storage::disk('public')->delete($category->thumbnail);
        $category->delete();

        session()->flash('status', [
          'code' => 'success',
          'message' => 'Kategori dari '.$name.' berhasil di hapus',
        ]);
      } catch (\Exception $e) {
        session()->flash('status', [
          'code' => 'danger',
          'message' => 'gagal menghapus kategori '.$name.' : ' . $e->getMessage(),
        ]);

        return redirect()->back();
      }

      return redirect($this->route);
    }
}
