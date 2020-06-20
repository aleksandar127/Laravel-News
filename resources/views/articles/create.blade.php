@extends('layouts.articles')
@section('content')
    <form action="/article" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('post')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="tite" name="title"  placeholder="title" required value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control" name="text" id="text" rows="5"  required>{{ old('text') }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Select</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
 @endsection
