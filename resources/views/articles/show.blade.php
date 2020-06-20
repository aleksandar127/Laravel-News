@extends('layouts.articles')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center h2 mb-3 mt-3"><a href="/article/{{$article->id}}" class="text-decoration-none text-dark">{{ $article->title }}</a></div>
        <div class="col-5"><img src="{{$article->image}}" class="img-fluid" alt="image"/></div>
        <div class="col-7">
            {{ $article->text }}<br><small>{{ $article->created_at }}</small><br><a href="/category/{{ $article->category->name }}"><small>{{ $article->category->name }}</small></a><br>
            <a href="/article/{{$article->id}}/edit" type="button" class="btn btn-primary">Edit</a><br>
            <form action='/article/{{$article->id}}' method='post'>
                @method('DELETE')
                {{ csrf_field() }}
                <button type="submit"  class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

</div>
@endsection
