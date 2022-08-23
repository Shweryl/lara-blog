@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Posts</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>Post Lists</h3>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                    @if(request('keyword'))
                        <span class="">Search By : "{{request('keyword')}}"</span>
                        <a href="{{route('post.index')}}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-trash-fill"></i></a>
                    @endif
                </div>
                <form action="{{route('post.index')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" required>
                        <button class="btn btn-secondary">
                            <i class="bi bi-search"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="w-25">Title</th>
                    <th>Category</th>
                    <th>Owner</th>
                    <th>Control</th>
                    <th>Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>
                            {{$post->title}}
                        </td>
                        <td>{{\App\Models\Category::find($post->category_id)->title}}</td>
                        <td>{{\App\Models\User::find($post->user_id)->name}}</td>
                        <td>
                            <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{route('post.destroy',$post->id)}}" class="d-inline-block" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <p class="text-black-50 mb-0">
                                <i class="bi bi-calendar"></i>
                                {{$post->created_at->format('d-M-Y')}}
                            </p>
                            <p class="text-black-50 mb-0">
                                <i class="bi bi-clock"></i>
                                {{$post->created_at->format('h:m A')}}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">There is no posts.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div>{{$posts->onEachSide(1)->links()}}</div>
        </div>
    </div>
@endsection
