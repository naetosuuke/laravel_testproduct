<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
}); // ->middleware('can:test'); // ゲートの設定方法　can:ゲート名

// Route::get('/dashboard', function () { // 認可ユーザーのみアクセス可能
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard'); // ユーザー認証、メアド確認済み

Route::get('/dashboard', [PostController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard'); // ユーザー認証、メアド確認済み

// ログインユーザーのみアクセス可能
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('post', PostController::class); // CRUD処理にかかわるルート設定を一括で登録 index create store show edit update destroy
});

// ------------------------Resource Controllerに処理を置換----------------------------------

// Route::get('/test', [TestController::class, 'test'])
// ->name('test'); // ルート名を指定 プロジェクト内で呼び出す時に使用

// // 投稿の閲覧
// Route::get('post', [PostController::class, 'index'])
// ->name('post.index');

// Route::get('post/show/{post}', [PostController::class, 'show'])
// ->name('post.show'); 

// // 投稿の作成
// Route::get('post/create', [PostController::class, 'create'])
// ->name('post.create'); 

// Route::post('post', [PostController::class, 'store'])
// ->name('post.store'); 

// // 投稿の更新
// Route::get('post/{post}/edit', [PostController::class, 'edit'])
// ->name('post.edit');

// Route::patch('post/{post}', [PostController::class, 'update'])
// ->name('post.update'); 

// // 投稿の削除
// Route::delete('post/{post}', [PostController::class, 'destroy'])
// ->name('post.destroy'); 

// // 管理ユーザーのみアクセス可能 routerで設定する場合
// // Route::middleware(['auth'])->group(function () {
//         Route::get('post', [PostController::class, 'index']);
//         Route::get('post/create', [PostController::class, 'create']);
// // });



require __DIR__.'/auth.php';

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});
