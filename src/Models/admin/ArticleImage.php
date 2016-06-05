<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
  protected $fillable = ['article_id', 'file_name', 'file_size', 'file_mime', 'file_path', 'created_by'];


  public function article()
  {
    return $this->belongsTo(\App\Article::class);
  }
}
