<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;


use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ユーザー一覧の取得処理などを行う
        $posts = Post::all();

        // ビューを返す
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        // データを作成して保存する
        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        // レスポンス
        return response()->json(['message' => '投稿が作成されました。', 'post' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $post_id = basename($request->path());
        $post = Post::find($post_id);
        $comments = Comment::findMany($post_id);
        return view('post.show',[
            'post'=>$post,
            'comments'=>$comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
