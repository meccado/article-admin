<?php

Route::group(['namespace' 	=> 'App\Http\Controllers',
							'middleware' 	=> ['web', 'throttle'],
 							], function(){
			//'prefix'=>'api/v1',
			Route::group(['prefix' =>  'admin',
                          'middleware' 	=> ['auth', 'admin'],
	 					 'namespace' 	=> 'Admin'], 
                         function(){
                      		Route::resource('tags', 'TagController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('articles', 'ArticleController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('categories', 'CategoryController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
													Route::post('articles/{articles}/upload', ['as' => 'admin.articles.upload', 'uses' => 'ArticleController@upload']);
													Route::get('articles/{articles}/image-upload', ['as' => 'admin.articles.image-upload', 'uses' => 'ArticleController@getUpload']);
			});
});

View::composer('*', function ($view) {
  $categories			= \App\Category::where('parent_id', '=', 0)->get();//
		if(!$categories){
			$categories 	= [];
		}
		$tags					= \App\Tag::with('articles')->get();
		if(!$tags){
			$tags 			= [];
		}
    $view->with(compact('categories', 'tags'));
});
