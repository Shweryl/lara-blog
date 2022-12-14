<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere('title','like',"%$keyword%")
                ->orWhere('title','like',"%$keyword%");
        })
            ->when(Auth::user()->isAuthor(),fn($q)=>$q->where("user_id",Auth::id()))
            ->latest('id')
            ->with('category','user')
            ->paginate(10)->withQueryString();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //return $request;
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if($request->hasFile('featured_image')){
            $newName = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs("public",$newName);
            $post->featured_image = $newName;
        }
        $post->save();

        foreach ($request->photos as $photo){
            $newName = uniqid()."_post_photo.".$photo->extension();
            $photo->storeAs("public",$newName);

            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newName;
            $photo->save();
        }
        return redirect()->route('post.index')->with('status',"New Post is added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //return $post->user;
        Gate::authorize('view',$post);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if(Gate::denies('update',$post)){
            return abort(403);
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description);
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if($request->hasFile('featured_image')){
            Storage::delete('public/'.$post->featured_image);
            $newName = uniqid()."_featured_image.".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs("public",$newName);
            $post->featured_image = $newName;
        }
        $post->update();
        foreach ($request->photos as $photo){
            $newName = uniqid()."_post_photo.".$photo->extension();
            $photo->storeAs("public",$newName);

            $photo = new Photo();
            $photo->post_id = $post->id;
            $photo->name = $newName;
            $photo->save();
        }
        return redirect()->route('post.index')->with('status',"Post is updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('delete',$post)){
            return abort(403,"You are not allowed to delete.");
        }
        if(isset($post->featured_image)){
            Storage::delete('public/'.$post->featured_image);
        }
        foreach ($post->photos as $photo){
            Storage::delete('public/'.$photo->name);
            $photo->delete();
        }
        $post->delete();
        return redirect()->route('post.index')->with('status',"Post is deleted succesfully.");
    }
}
