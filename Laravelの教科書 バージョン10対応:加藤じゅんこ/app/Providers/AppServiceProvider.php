<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // Gateインポート
use App\Models\User; // Userモデルインポート

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('test',function(User $user) { // Gate定義 名前と機能
            if($user->id === 1) {
                return true;
            }
            return false;
        });
    }
}
