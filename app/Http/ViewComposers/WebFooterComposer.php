<?php

namespace App\Http\ViewComposers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class WebFooterComposer
{
    public function __construct()
    {
        //
    }

    /**
     * 底部栏目
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Cache::remember('webFooter', 5, function () {
            return Category::with(['articles' => function ($query) {
                $query->select('id', 'title', 'category_id')->limit(5);
            }])->where('parent_id', 0)->offset(1)->limit(4)->get(['id', 'title']);
        });
        $abouts = Cache::remember('abouts', 5, function () {
            return Article::where('category_id', 1)->get(['id', 'title']);
        });
        $view->with(compact('categories', 'abouts'));
    }
}