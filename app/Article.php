<?php

namespace App;

use App\Filters\Sort;
use App\Filters\Search;
use App\Filters\Category;
use Illuminate\Support\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'text', 'file', 'user_id', 'category_id', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function scopeRecent($query)
    {
        return $query->whereDay('created_at', Carbon::now()->day)
            ->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
    }

    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }


    public static function allArticles()
    {
        $posts = app(Pipeline::class)
            ->send(\App\Article::query()->with('category'))
            ->through([

                Category::class,
                Sort::class,
                Search::class,

            ])
            ->thenReturn()
            ->latest()
            ->paginate(10);
        return $posts;
    }
}
