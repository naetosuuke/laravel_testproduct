<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChirpCreatedNotifications implements ShouldQueue // キューを使用する
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        // chirpの著者以外の全ユーザーに通知を送信
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) { // cursorでデータをイテレータ(逐次処理)で取得
            $user->notify(new NewChirp($event->chirp));
        }
    }
}
