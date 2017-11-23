<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function lanmu()
    {
        return $this->belongsTo(Lanmu::class, 'lanmu_id');
    }

    public function data()
    {
        return $this->hasOne(ArticleData::class);
    }

    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'user_id');
    }

}
