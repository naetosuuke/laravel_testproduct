<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts=Post::with('user')->get(); // リレーション先のデータをあらかじめ取得 (Eager Load)
        $posts = Post::paginate(10); // すべての投稿を表示
        // $posts=Post::where('user_id', auth()->id())->get(); // ログインユーザーの投稿のみ表示
        // $posts=Post::where('user_id', '=!', auth()->id())->get(); // ログインユーザー以外の投稿のみ表示
        // $posts=Pos;;whereDate('created_at', '>= ' '2021-09-23')->get(); // 2021-09-23以降の投稿のみ表示
        return view('post.index', compact('posts'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id'] = auth()->id(); 

        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました'); // 一回限りのセッションメッセージ keyvalue
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([ 
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id(); // ログインユーザーid
        $post->update($validated);
        $request->session()->flash('message', '更新しました');
        return redirect()->route('post.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect('post');
    }
}
