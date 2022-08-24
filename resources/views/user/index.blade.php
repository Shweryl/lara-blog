@extends('layouts/app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h3>User Lists</h3>
            <hr>
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                    @if(request('keyword'))
                        <span class="">Search By : "{{request('keyword')}}"</span>
                        <a href="{{route('user.index')}}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-trash-fill"></i></a>
                    @endif
                </div>
                <form action="{{route('user.index')}}" method="get">
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
                    <th class="w-25">Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Control</th>
                    <th>Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a href="{{route('user.show',$user->id)}}" class="btn btn-sm btn-outline-dark">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            @can('update',$user)
                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            @endcan
                            @can('delete',$user)
                                <form action="{{route('user.destroy',$user->id)}}" class="d-inline-block" method="post">
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
                                {{$user->created_at->format('d-M-Y')}}
                            </p>
                            <p class="text-black-50 mb-0">
                                <i class="bi bi-clock"></i>
                                {{$user->created_at->format('h:m A')}}
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
            <div>{{$users->onEachSide(1)->links()}}</div>
        </div>
    </div>
@endsection
