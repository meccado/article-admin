@if(isset($tag))
  {!! Form::model($tag,
    ['route'     => ['admin.tags.update', $tag->id],
    'method'     => 'PUT',
    'class'      => 'form-horizontal',
    'files'      => true])
    !!}
  @else
    {!! Form::open(['route' =>'admin.tags.store',
      'method' =>'POST',
      'class'  =>'form-horizontal',
      'files'  =>'true',
    ])
    !!}
  @endif

  <fieldset>
    <!-- Text input-->
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      {!! Form::label('name', trans('tag.tags-create-name'), ['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-10">
        {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=> trans('tag.tags-create-name_placeholder')]) !!}
        @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        @if (isset($tag))
          {!! Form::submit(trans('tag.tags-edit-btnupdate'), ['class' => 'btn btn-primary']) !!}
        @else
          {!! Form::submit(trans('tag.tags-create-btncreate'), ['class' => 'btn btn-primary']) !!}
        @endif
      </div>
    </div>
  </fieldset>
  {!! Form::close() !!}
