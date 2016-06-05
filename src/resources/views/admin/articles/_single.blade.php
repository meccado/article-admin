<div class="col-md-12">
    <div class="col-md-12" id="article_template">
        <div class="dropzone-previews"></div>
        {!! Form::open(['route'     => ['admin.articles.upload', $article->id],
                        'method'	=>'POST',
                        'class'		=>'dropzone',
                        'id'		  =>'article_dropzone',
                        'files'		=>'true',

                    ])
        !!}
        {!! Form::close() !!}
    </div>
</div>
