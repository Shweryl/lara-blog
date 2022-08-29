@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>Category Lists</h3>
            <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    @if(Auth::user()->role !== "author")
                    <th>Owner</th>
                    @endif
                    <th>Post Count</th>
                    <th>Control</th>
                    <th>Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>
                            {{$category->title}}
                            <br>
                            <span class="badge bg-dark">{{$category->slug}}</span>
                        </td>
                        @if(Auth::user()->role !== "author")
                        <td>{{$category->user->name}}</td>
                        @endif
                        <td>{{$category->posts()->count()}}</td>
                        <td>
                            @can('update',$category)
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('delete',$category)
                                <form action="{{route('category.destroy',$category->id)}}" class="d-inline-block" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                        <td>
                            <p class="text-black-50 mb-0">
                                <i class="bi bi-calendar"></i>
                                {{$category->created_at->format('d-M-Y')}}
                            </p>
                            <p class="text-black-50 mb-0">
                                <i class="bi bi-clock"></i>
                                {{$category->created_at->format('h:m A')}}
                            </p>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
