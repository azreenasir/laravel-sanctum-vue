<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
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
        $post = Post::with('category')->latest()->get();
        return PostResource::collection($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'category' => 'required',
            'title' => 'required|min:5',
            'body' => 'required'
        ]);

        $category = Category::findOrFail(request('category'));
        $post = Post::create([
            'title' => $request->title,
            'category_id' => $category->id,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ]);

        return response()->json([
            'message' => 'Your Post was created',
            'Post' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = PostResource::make($post);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        request()->validate([
            'category' => 'required',
            'title' => 'required|min:5',
            'body' => 'required'
        ]);

        $category = Category::findOrFail(request('category'));
        $post->update([
            'title' => $request->title,
            'category_id' => $category->id,
            'body' => $request->body
        ]);

        return response()->json([
            'message' => 'Your Post was updated',
            'Post' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Your Post was deleted',
            'Post' => $post,
        ], 200);
    }
}
