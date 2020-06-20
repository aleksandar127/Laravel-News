<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function index($category)
    {
        $categoryModel = Category::where('name', $category)->limit(1)->get();
        $articles = $categoryModel[0]->articles()->latest()->paginate(15);
        return view('articles.index', ['articles' => $articles]);
    }
}
