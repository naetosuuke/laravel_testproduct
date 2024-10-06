<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function index() {
        $posts=Post::with('user')->get(); // リレーション先のデータをあらかじめ取得 (Eager Load)

        // $posts = Post::all(); // すべての投稿を表示
        // $posts=Post::where('user_id', auth()->id())->get(); // ログインユーザーの投稿のみ表示
        // $posts=Post::where('user_id', '=!', auth()->id())->get(); // ログインユーザー以外の投稿のみ表示
        // $posts=Pos;;whereDate('created_at', '>= ' '2021-09-23')->get(); // 2021-09-23以降の投稿のみ表示
        return view('post.index', compact('posts'));    
    }

    public function create() {
        return view('post.create');
    }

    public function show(Post $post) { // 引数 引数渡すとPostモデルでidが合致するデータを取得 (DI)
        return view('post.show', compact('post'));
    }

    public function store(Request $request) {
        Gate::authorize('test'); // コントローラー側でゲートを設定
        $validated = $request->validate([ // バリデーションをControllerで実行
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id(); // ログインユーザーid

        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました'); // 一回限りのセッションメッセージ keyvalue
        return back();
    }
    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {// 更新処理 送信内容と更新対象postを引数に取る
        $validated = $request->validate([ 
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id(); // ログインユーザーid
        $post->update($validated);
        $request->session()->flash('message', '更新しました');
        return back();
    }

    public function destroy(Request $request, Post $post) {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect('post');
        // return redirect()->route('post.index'); // ルートで定義した名前でもリダイレクトできる
    }

}
