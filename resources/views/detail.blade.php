@extends('master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="mb-3">
                    <h3 class=" text-center">{{$post->title}}</h3>
                    <div class="text-center">
                        <a href="#">
                                    <span class="badge bg-secondary ">
                                        {{$post->category->title}}
                                    </span>
                        </a>
                    </div>
                    <div class="my-3">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($post->photos as $key=>$photo)
                                    <div class="carousel-item {{$key===0?'active':''}}">
                                        <a class="venobox" data-gall="myGallery" href="{{asset('storage/'.$photo->name)}}">
                                            <img src="{{asset('storage/'.$photo->name)}}" class="d-block post-detail-img w-100">
                                        </a>

                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <p class="my-3" style="white-space:pre-wrap">{{$post->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <p class="mb-0 text-black-50 fw-bold ">{{$post->user->name}}</p>
                            <p class="mb-0 text-secondary">{{$post->created_at->diffforhumans()}}</p>
                        </div>
                        <div class="">
                            @can('update',$post)
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
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
