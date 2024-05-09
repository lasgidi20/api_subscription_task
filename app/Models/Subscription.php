<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subscription extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'confirm',
        'role'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
