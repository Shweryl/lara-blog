@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <p>This is photo page</p>
            <div class="gallery">
                @forelse(Auth::user()->photos as $photo)
                    <img src="{{asset('storage/'.$photo->name)}}" class="w-100 mb-3 rounded" alt="">
                @empty
                    <h2>There is no photos yet.</h2>
                @endforelse
            </div>
        </div>
    </div>
@endsection
