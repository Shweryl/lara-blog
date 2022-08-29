@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Post</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>Create New Post</h3>
            <hr>
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title">Post Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{old('title')}}"
                           class="form-control bg-white @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category">Select Category</label>
                    <select name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}" @selected($category->id == old('category'))>{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photos">Post Photos</label>
                    <input type="file"
                           name="photos[]"
                           id="photos"
                           class="form-control bg-white @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                            multiple>
                    @error('photos')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @error('photos.*')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description">Post Description</label>
                    <textarea type="text"
                           rows="8"
                           name="description"
                           id="description" class="form-control bg-white @error('description') is-invalid @enderror">
                    {{old('description')}}
                    </textarea>
                    @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <label for="featured_image">Feature Photo</label>
                        <input type="file"
                               name="featured_image"
                               id="featured_image"
                               class="form-control bg-white @error('featured_image') is-invalid @enderror">
                        @error('featured_image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="">
                        <button class="btn btn-primary">Create Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
