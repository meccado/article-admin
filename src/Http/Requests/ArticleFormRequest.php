<?php
namespace Meccado\ArticleAdmin\Http\Requests;

use Meccado\ArticleAdmin\Http\Requests\Request as Request;

class ArticleFormRequest extends Request{

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
		switch($this->method())
		{
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'name' 				=> 'required|min:3|max:255|unique:articles',// name',
					'content' 		=> 'required|min:3',
					'slug'   			=> 'required|unique:articles,slug,' . $this->get('id'),
					//'price' 			=> 'required|numeric',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					//'name' 				=> 'required|min:3|unique:products',// title,'.$this->products,
					//'description' => 'required|min:2',
					//'price' 			=> 'required|numeric',
					//'sku'         => 'required|unique:products,sku,' . $this->get('id'),
					//'image'       => 'required|mimes:jpeg,bmp,png'
					//'article.title' => 'required|unique:articles,title,'.Route::input('articles').'|max:255',
				];
			}
			default:
			break;
		}
		return [];
	}

	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize()
	{
		return true;
	}
}
