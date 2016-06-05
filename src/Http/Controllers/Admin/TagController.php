<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag as Tag;

class TagController extends Controller
{

  /**
  * @var Tag
  */
  protected $tags;

  public function __construct(Tag $tags)
  {
    $this->tags = $tags;
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\View\View
  */
  public function index()
  {
    $tags = $this->tags->get();
    return \View::make('admin.tags.index', compact('tags'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\View\View
  */
  public function create()
  {
    return \View::make('admin.tags.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\RedirectResponse
  */
  public function store(Request $request)
  {
    $this->tags->create($request->only('name'));
    return \Redirect::route('admin.tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_created'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function show(Tag $tag)
  {
    $articles = $tag->articles()
                    ->latest('published_at')
                    ->published()->get();
		return view('admin.articles.index', compact('articles'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\View\View
  */
  public function edit($id)
  {
    $tag = $this->tags->findOrFail($id);
    return \View::make('admin.tags.edit', compact('tag'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function update(Request $request, $id)
  {
    $this->tags->findOrFail($id)->update($request->only('name'));
    return \Redirect::route('admin.tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_updated'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\RedirectResponse
  */
  public function destroy($id)
  {
    $this->tags->findOrFail($id)->delete();
    return \Redirect::route('admin.tags.index')
    ->withMessage(trans('tag.tags-controller-successfully_deleted'));
  }
}
