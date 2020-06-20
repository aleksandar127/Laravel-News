@extends('layouts.articles')
@section('content')
<div class="container">
    <form class="mt-2 w-50 m-auto" action='{{action('ArticleController@index')}}' method='GET'>
        @csrf
        <div class="input-group mb-3">
        <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search">
        <select class="browser-default custom-select custom-select-md mb-3 ml-3" name="category">
        <option selected value="">Category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn h-75 btn-dark ml-3" type="submit">Submit</button>
        </div>
        </div>
    </form>
    @foreach ($articles as $article)
        <div class="row">
            <div class="col-12 text-center h2 mb-4 mt-4">
                <a href="/article/{{$article->id}}" class="text-decoration-none text-dark">{{ $article->title }}</a>
            </div>
            <div class="col-5">
                <img src="{{$article->image}}" class="img-fluid" alt="image"/>
            </div>
            <div class="col-7">
                {{ $article->text }}<br><small>{{ $article->created_at }}</small><br><a href="/category/{{ $article->category->name }}"><small>{{ $article->category->name }}</small></a>
            </div>
        </div>
    @endforeach

    {{ $articles->links() }}
</div>
<br>
 @endsection

