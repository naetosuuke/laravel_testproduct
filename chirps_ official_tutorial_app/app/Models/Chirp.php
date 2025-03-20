<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [ // created イベントに対し、 ChirpCreated イベントをディスパッチする
        'created' => ChirpCreated::class,
    ];

    public function user(): BelongsTo //Userモデルのhasmaんyと対応
    {
        return $this->belongsTo(User::class);
    }
}
