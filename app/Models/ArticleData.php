<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleData extends Model
{
    protected $fillable = [
        'article_id', 'content'
    ];

    public function article()
    {
        return $this->be(Article::class);
    }
}
