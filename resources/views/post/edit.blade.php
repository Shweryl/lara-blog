@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>Edit Post</h3>
            <hr>
            <form action="{{route('post.update',$post->id)}}" id="form-parent" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
            </form>
                <div class="mb-3">
                    <label for="title">Post Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{old('title',$post->title)}}"
                           form="form-parent"
                           class="form-control bg-white @error('title') is-invalid @enderror">

                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category">Select Category</label>
                    <select name="category" id="category" form="form-parent" class="form-select @error('category') is-invalid @enderror">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}" @selected($category->id == old('category',$post->category_id))>{{$category->title}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="mb-2">
                        <label for="photos">Post Photos</label>
                        <input type="file"
                               name="photos[]"
                               id="photos"
                               form="form-parent"
                               class="form-control bg-white @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                               multiple>
                        @error('photos')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        @error('photos.*')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="d-flex">
                        @foreach($post->photos as $photo)
                            <div class="position-relative me-1">
                                <img src="{{asset('storage/'.$photo->name)}}" height="100" class="rounded" alt="">
                                <form action="{{route('photo.destroy',$photo->id)}}" method="post" class="">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-dark position-absolute bottom-0 end-0">
                                        <i class="bi bi-trash-fill text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Post Description</label>
                    <textarea type="text"
                              rows="8"
                              name="description"
                              id="description"
                              form="form-parent"
                              class="form-control bg-white @error('description') is-invalid @enderror"
                    >{{old('description',$post->description)}}
                    </textarea>
                    @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">

                        <div class="me-2">
                            <label for="featured_image">Upload Photo</label>
                            <input type="file"
                                   name="featured_image"
                                   id="featured_image"
                                   form="form-parent"
                                   class="form-control bg-white @error('featured_image') is-invalid @enderror">
                            @error('featured_image')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="">
                            @isset($post->featured_image)
                                <img src="{{asset('storage/'.$post->featured_image)}}" height="70" class="rounded" alt="">
                            @endisset
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" form="form-parent">Update Post</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
