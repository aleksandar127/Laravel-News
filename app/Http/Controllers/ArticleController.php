<?php

namespace App\Http\Controllers;


use App\Article;
use App\Weather;
use App\Category;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Notifications\NewArticle;
use Illuminate\Support\Facades\File;



class ArticleController extends Controller
{
    use ImageUpload;


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {

        $weather =  Weather::getData(Weather::check());
        $articles = Article::allArticles();
        $categories = Category::all();
        return view('articles.index', ['articles' => $articles, 'categories' => $categories, 'weather' => $weather]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        $categories = Category::all();
        return view('articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->validate(['title' => 'bail|required|max:20', 'text' => 'required', 'category_id' => 'int']);
        $request->session()->flash('success', 'success!');
        $params['user_id'] = auth()->user()->id;
        $params['image'] = $this->img;

        if ($request->image) {

            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);

            $filePath = $this->ImageUpload($request->image); //Passing $request->image as parameter

            $params['image'] = $filePath;
        }
        $article = Article::create($params);
        $user = $article->user;
        $user->notify(new NewArticle($article));
        return redirect('/article/' . $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)

    {

        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $categories = Category::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $params = $request->validate(['title' => 'bail|required|max:20', 'text' => 'required', 'category_id' => 'int']);
        $article->title = $params['title'];
        $article->text = $params['text'];
        $article->category_id =  $params['category_id'];
        if ($request->image) {

            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);

            $filePath = $this->ImageUpload($request->image); //Passing $request->image as parameter
            if ($article->image !== $this->img) {
                File::delete($article->image);
            }
            $article->image = $filePath;
        }

        $article->save();
        $request->session()->flash('success', 'success!');
        return redirect('/article/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article->image !== $this->img) {
            File::delete($article->image);
        }
        $article->delete();

        return redirect('/article')->with('success', 'success!');
    }

    public function myArticles()
    {
        $articles = Article::with('category')->currentuser()->latest()->paginate(15);
        $categories = Category::all();
        return view('articles.index', ['articles' => $articles, 'categories' => $categories]);
    }

    public function ajax(Request $request)
    {

        auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();
        return response()->json(['success' => $request->id]);
    }
}
