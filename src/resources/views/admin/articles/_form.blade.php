@if(isset($article))
  {!! Form::model($article, ['route' => ['admin.articles.update', $article->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
@else
  {!! Form::open(['route' =>'admin.articles.store', 'method' =>'POST', 'class'  =>'form-horizontal', 'files'  =>'true', ])!!}
@endif

<fieldset>
  <div class="row">
    <div class="col-md-3" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 10px;">

      <!-- Categories Form Input -->
      <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
        {!!Form::label('categories', trans('admin_article::article.articles-create-categories_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!! Form::select('categories[]', $category_items, $categories_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('categories'))
            <span class="help-block">
              <strong>{{ $errors->first('categories') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Slug Form Input -->
      <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        {!!Form::label('slug', trans('admin_article::article.articles-create-slug_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!!Form::text('slug', old('slug'), ['required', 'class' => 'form-control ', 'placeholder'=>'Type article slug here ..'])!!}
          @if ($errors->has('slug'))
            <span class="help-block">
              <strong>{{ $errors->first('slug') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Published_at Form Input -->
      <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }} ">
        {!! Form::label('published_at', trans('admin_article::article.articles-create-published_at_label') , ['class'=>'col-md-4 control-label']) !!}
        <div class="col-xs-8">
          @if(isset($article ))
            {!! Form::input('date', 'published_at', $article->published_at , ['class' => 'form-control']) !!}
          @else
            {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
          @endif
          @if ($errors->has('published_at'))
            <span class="help-block">
              <strong>{{ $errors->first('published_at') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- Tag Form Input -->
      <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
        {!!Form::label('tags', trans('admin_article::article.articles-create-tag_label'), ['class'=>'col-md-4 control-label'])!!}
        <div class="col-md-8">
          {!! Form::select('tags[]', $tag_items, $tags_selected, ['class' => 'form-control', 'multiple' => 'multiple']); !!}
          @if ($errors->has('tags'))
            <span class="help-block">
              <strong>{{ $errors->first('tags') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <!-- published Form Input -->
      <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
        {!! Form::label('published', trans('admin_article::article.articles-create-published_label') , ['class'=>'col-md-4 control-label']) !!}
        <div class="col-xs-8">
          <div class="checkbox icheck">
            {{Form::checkbox('published', old('published'))}}
            @if ($errors->has('published'))
              <span class="help-block">
                <strong>{{ $errors->first('published') }}</strong>
              </span>
            @endif
          </div>
        </div>
      </div>

    </div><!-- /.col -->



    <div class="col-md-8" style="background-color: #FFF; padding: 20px; box-shadow: 0 0 20px #AAA; margin-left: 35px;">
      <!-- Name Form Input -->
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="col-md-12">
          {{--!!Form::label('name', trans('admin_article::article.articles-create-title_label'), ['class'=>'col-md-2 control-label'])!!--}}
        </div>
        <div class="col-md-12">
          {!!Form::text('name', old('name'),['required',
            'class' => 'form-control ', 'placeholder'=>"Type article's title here ..."])!!}
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <!-- Article Description Form Input -->
        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
          {{--!!Form::label('content', trans('admin_article::article.articles-create-content_label'), ['class'=>'col-md-2 control-label'])!!--}}
          <div class="col-md-12">
            {!!Form::textArea('content', old('content'),['required', 'class' => 'form-control', 'placeholder'=>'Enter detail information for the article', 'max-length'=>'250'])!!}
            @if ($errors->has('content'))
              <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10">
            @if (isset($article))
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Update Article Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
            @else
              {!! Form::button('<i class="fa fa-btn fa-save"></i> Save Article Item!', ['type'=>'submit', 'class' =>'btn btn-primary btn-flat']) !!}
            @endif
          </div>
        </div>

      </div><!-- /.col -->
    </div><!-- /.row -->

  </fieldset>
  {!! Form::close() !!}
