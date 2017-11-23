<?php

namespace App\Models;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Lanmu extends Model
{
    use ModelTree, AdminBuilder;

    protected $casts = [
        'hide' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('hide', 0);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
