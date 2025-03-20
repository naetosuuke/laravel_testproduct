<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    // 管理者のみアクセス可能とする自作ミドルウェア
    {   
        if(auth()->user()->role == 'admin') { // auth()はログインしていないとアクセス不可能 非ログイン状態でアクセスするとエラー(null)
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
