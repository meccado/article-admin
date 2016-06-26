<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Meccado\ArticleAdmin\Http\Requests\ArticleFormRequest as ArticleFormRequest;
use Meccado\ArticleAdmin\Http\Requests\ImageFormRequest as ImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use App\Article as Article;
use App\Category as Category;
use App\Tag as Tag;
use Illuminate\Support\Facades\File as File;
use Image as Image;

class ArticleController extends Controller
{

  /**
  * @var Tag
  */
  protected $articles;

  public function __construct(Article $articles)
  {
    $this->articles = $articles;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $articles =  $this->articles->latest('published_at')
    ->published()
    ->get();
    //$articles = Article::with('Categories')->get();
    return view('admin.articles.index',['articles' => $articles]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $category_items = Category::lists('name', 'id')->toarray();
    $tag_items = Tag::lists('name', 'id')->toarray();
    $categories_selected = [];
    $tags_selected = [];
    return view('admin.articles.store', compact('category_items', 'categories_selected', 'tag_items', 'tags_selected'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ArticleFormRequest $request)
  {
    $article = $this->articles->create([
      'name'              => $request->get('name'),
      'content'           => $request->get('content'),
      'slug'              => str_slug($request->get('slug')),
      'published'         => $request->input('published') === 'on' ? true : false,
      'published_at'      => $request->input('published_at'),
    ]);
    $article->save();
    foreach ($request->categories as $index =>$category_id) {
      $category = Category::whereId($category_id)->first();
      $article->assignCategory($category);
    }

    foreach ($request->tags as $index =>$tag_id) {
      $tag = Tag::whereId($tag_id)->first();
      $article->assignTag($tag);
    }

    return \Redirect::route('admin.articles.index')->with('flash_message', 'Article added!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Article $articles)
  {
    //$article = $this->articles->findOrFail($id);
    return view('admin_article::admin.articles.show', ['article' => $articles]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $article = $this->articles->findOrFail($id);
    $categories_selected = $article->categories->lists('id')->toarray();
    $tags_selected = $article->tags->lists('id')->toarray();
    $tag_items = Tag::lists('name', 'id')->toarray();
    $category_items = Category::lists('name', 'id')->toarray();
    return view('admin.articles.update', compact('article', 'tags_selected', 'categories_selected', 'category_items', 'tag_items'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(ArticleFormRequest $request, $id)
  {
    $article = $this->articles->whereId($id)->first();
    $article->categories()->detach();
    $article->tags()->detach();
    $article->name              = $request->get('name');
    $article->content           = $request->get('content');
    $article->slug              = str_slug($request->get('slug'));
    $article->published         = $request->input('published') === 'on' ? true : false;
    $article->published_at      = $request->input('published_at');
    $article->update();

    foreach ($request->categories as $index =>$category_id) {
      $category = Category::whereId($category_id)->first();
      $article->assignCategory($category);
    }

    foreach ($request->tags as $index =>$tag_id) {
      $tag = Tag::whereId($tag_id)->first();
      $article->assignTag($tag);
    }
    return \Redirect::route('admin.articles.index')->with('flash_message', 'Article added!');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $article = $this->articles->findOrFail($id);
    if($article){
      $article->delete();
      return \Redirect::to('admin/articles')
      ->with('flash_message', 'Article Deleted');
    }
    return \Redirect::to('admin/articles')
    ->with('flash_message', 'Something went wrong, please try again');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function getUpload($id)
  {
    $article = $this->articles->findOrFail($id);
    return \View::make('admin.articles.upload')->with(compact('article'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function upload(ImageFormRequest $request, $id)
  {
    if(Input::hasFile('file')) {
      $file = $request->file('file');
      $filename = uniqid() . $file->getClientOriginalName();
      $original ='assets\images\articles\original\\'.$filename;
      $thumbnail = 'assets\images\articles\thumbnail\\'.$filename;
      $resize = 'assets\images\articles\resize\\'.$filename;
      if (!File::exists('assets\images\articles\original'))
      {
        File::makeDirectory('assets\images\articles\original', $mode = 0777, true, true);
        if (!File::exists('assets\images\articles\thumbnail')){File::makeDirectory('assets\images\articles\thumbnail', $mode = 0777, true, true);}
        if (!File::exists('assets\images\articles\resize')){File::makeDirectory('assets\images\articles\resize', $mode = 0777, true, true);}
      }
      // upload new image
      $img = Image::make($file->getRealPath());
      $img->save($original);// original
      $img->fit('150', '150'); // thumbnail (grab)
      $img->save($thumbnail);
      $img->resize('300', '300'); // resize and set true if you want proportional image resize
      $img->save($resize);
      $img->destroy();
      $article = $this->articles->find($id);
      $image = $article->images()->create([
        'article_id'   => $request->input('article_id'),
        'file_name'     => $filename,
        'file_size'     => $file->getClientSize(),
        'file_mime'     => $file->getClientMimeType(),
        'file_path'     => 'assets/images/articles/original/'.$filename,
        'created_by'    => \Auth::user() ? \Auth::user()->id : 0,
      ]);
      return response()->json($image, 200);
    }else{
      return response()->json(false, 200);
    }
  }

}
