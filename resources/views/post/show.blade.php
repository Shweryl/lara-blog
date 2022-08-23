@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
            <li class="breadcrumb-item"><a href="{{route('post.create')}}">Create Post</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Details</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>{{$post->title}}</h3>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <span class="badge bg-secondary">
                        <i class="bi bi-grid"></i>
                        {{\App\Models\Category::find($post->category_id)->title}}
                    </span>
                    <span class="badge bg-secondary">
                        <i class="bi bi-person"></i>
                        {{\App\Models\User::find($post->user_id)->name}}
                    </span>
                </div>
                <div class="">
                    <span class="text-secondary me-1">
                        <i class="bi bi-calendar"></i>
                        {{$post->created_at->format('d-M-Y')}}
                    </span>
                    <span class="text-secondary me-1">
                        <i class="bi bi-clock"></i>
                        {{$post->created_at->format('h:m A')}}
                    </span>
                </div>
            </div>
            <div class="my-3">
                @isset($post->featured_image)
                    <img src="{{asset('storage/'.$post->featured_image)}}" class="w-100" alt="">
                @endisset
            </div>
            <p>{{$post->description}}</p>
        </div>
    </div>
@endsection
