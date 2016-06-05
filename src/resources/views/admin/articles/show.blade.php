@extends('admin.layouts.admin-master')

@section('content')

  <div class="row">
    <div class="col-md-3" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 10px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('article.articles-show-create_article_menu') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-12">
              @unless ($article->tags->isEmpty())
                <h5>Tag:</h5>
                <ul>
                  @foreach ($article->tags as $tag)
                    <li>{!! link_to_action('Admin\TagController@show', $tag->name, ['name' => $tag->name]) !!}</li>
                  @endforeach
                </ul>
              @endif

              @unless ($article->categories->isEmpty())
                <h5>Category:</h5>
                <ul>
                  @foreach ($article->categories as $category)
                    <li>{!! link_to_action('Admin\CategoryController@show', $category->name, ['name' => $category->name]) !!}</li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer"><!-- .box-footer-->
          {{ trans('article.articles-show-footer_menu') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->

    <div class="col-md-8" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 35px;">
      <div class="box box-primary"><!-- .box -->
        <div class="box-header with-border"><!-- .box-header -->
          <h3 class="box-title pull-left">
            {{ trans('article.articles-show-create_article') }}
          </h3>
        </div><!-- /.box-header -->

        <div class="box-body"><!-- .box-body -->
          <div class="row">
            <div class="col-sm-12">
              <h1>{{ $article->title }}</h1>
              <article>
                {!! $article->content !!}
              </article>
            </div>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer"><!-- .box-footer-->
          {{ trans('article.articles-show-footer') }}
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
