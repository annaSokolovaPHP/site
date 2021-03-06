<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesArticles extends Model
{
    protected $table = 'categoriesArticles';
    protected $fillable = [
        'name',
        'slug',
    ];
    static function findBySlug($slug)
    {
        return CategoriesArticles::where('slug', $slug)->First();
    }

    public function rules($id = null)
    {
        return [
            'name' => 'required|max:30|unique:categoriesArticles,name,'.$id,
            'slug' => 'required|max:15|unique:categoriesArticles,slug,'.$id,
        ];
    }
    public function article(){
        return $this->belongsTo('App\Article','id','category_id');
    }

    static function getActiveCategories(){
        /*
        return Article::findByStatus('PUBLISHED')->
        leftJoin('categoriesArticles', 'articles.category_id', '=', 'categoriesArticles.id')->distinct()
            ->get();
        */
        return CategoriesArticles::whereHas('article', function ($query) {
            $query->where('status', '=', 'PUBLISHED');
        })->get();
        /*
        return $categoriesArticles=CategoriesArticles::
        whereExists(function ($query) {
            $query->select('category_id')
                ->from('articles')
                ->whereRaw('articles.category_id = categoriesArticles.id')->where('status', '=', 'PUBLISHED');
        })
            ->get();
        */
    }
}
