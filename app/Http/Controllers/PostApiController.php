<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(){
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")
                ->orWhere('title','like',"%$keyword%");
        })
            ->latest('id')
            ->with('category','user')
            ->paginate(10)->withQueryString();
        return response()->json($posts);
    }

    public function detail($id){
        $post = Post::where('id',$id)->with('category','user','photos')->first();
        return response()->json($post);
    }
}
