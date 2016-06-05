<table id="datatable" class="table table-striped table-hover table-responsive datatable">
    <thead>
        <tr>
            <th>##</th>
            <th>{!! trans('article.articles-index-name_label') !!}</th>
            {{-- <th>{!! trans('article.articles-index-content_label')!!}</th> --}}
            <th>{!! trans('article.articles-index-slug_label') !!}</th>
            <th>{!! trans('article.articles-index-published_at_label') !!}</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($articles as $article)
            <tr>
                <th>{{$article->id}}</th>
                <td>
                    {{$article->name}}
                </td>
                {{-- <td>{{$article->content}}</td> --}}
                <td>{{$article->slug}}</td>
                <td>{{$article->published_at }}</td>
                <td>
                    <div class="row">
                        <div class="col-sm-1">
                            <a href="{{route('admin.articles.show', ['id'=>$article->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('article.articles-view_tooltip') !!}"
                                class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            <a href="{{route('admin.articles.edit',['id'=>$article->id])}}"
                                data-toggle="tooltip"
                                data-original-title="{!! trans('article.articles-update_tooltip') !!}"
                                class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="col-sm-1 col-sm-offset-1">
                            {!! Form::open(['route' => ['admin.articles.destroy', $article->id],
                            'class' => 'form-horizontal confirm',
                            'role' => 'form', 'method' => 'DELETE']) !!}
                                <button data-toggle="tooltip"
                                    data-original-title="{{trans('article.articles-delete_tooltip') }}"
                                    type="submit" class="btn btn-danger confirm-btn btn-flat">
                                        <i class="fa fa-trash-o"></i>
                                </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>
                <button class="btn btn-primary btn-flat" type="button">
                  {{trans('article.articles-counter_badge') }} <span class="badge">{{count($articles)}}</span>
                </button>
            </th>
        </tr>
    </tfoot>
</table>
