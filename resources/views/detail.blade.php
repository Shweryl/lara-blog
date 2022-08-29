@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="mb-0">{{$post->title}}</h3>
                        <div class="">
                            <a href="#">
                                    <span class="badge bg-secondary">
                                        {{$post->category->title}}
                                    </span>
                            </a>
                        </div>
                        <div class="my-3">
                            @foreach($post->photos as $photo)
                                <img src="{{asset('storage/'.$photo->name)}}" height="100" class="rounded" alt="">
                            @endforeach
                        </div>
                        <p class="my-3">{{$post->description}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="mb-0 text-black-50 fw-bold ">{{$post->user->name}}</p>
                                <p class="mb-0 text-secondary">{{$post->created_at->diffforhumans()}}</p>
                            </div>
                            <a href="{{route('page.index')}}" class="btn btn-primary">
                                All Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
