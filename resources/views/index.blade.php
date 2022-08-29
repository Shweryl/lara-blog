@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h2 class="bg-white fw-bold border p-3 rounded">Blog Posts</h2>
                <div class="">
                    @isset($category)
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5">Filter By => {{$category->title}}</span>
                            <a href="{{route('page.index')}}" class="btn btn-outline-primary">See All</a>
                        </div>
                    @endisset
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="">
                        @if(request('keyword'))
                            <span class="fs-5">Search By => {{request('keyword')}}</span>
                            <a href="{{route('page.index')}}"><i class="bi bi-trash3-fill"></i></a>
                        @endif
                    </div>
                    <form method="get">
                        <div class="input-group">
                            <input  type="text" class="form-control bg-white" name="keyword" value="{{request('keyword')}}">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

                @forelse($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="mb-0">{{$post->title}}</h3>
                            <div class="">
                                <a href="{{route('page.category',$post->category->slug)}}">
                                    <span class="badge bg-secondary">
                                        {{$post->category->title}}
                                    </span>
                                </a>
                            </div>
                            <p class="my-3">{{$post->excerpt}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p class="mb-0 text-black-50 fw-bold ">{{$post->user->name}}</p>
                                    <p class="mb-0 text-secondary">{{$post->created_at->diffforhumans()}}</p>
                                </div>
                                <a href="{{route('page.detail',$post->slug)}}" class="btn btn-primary">
                                    Show More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                <div class="">
                    <div>{{$posts->onEachSide(1)->links()}}</div>
                </div>
            </div>
        </div>
    </div>
@stop
