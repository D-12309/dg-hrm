<?php

namespace App\Models;

use App\Models\User;
use App\Models\PushNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PushNotificationUser extends Model
{
    use HasFactory;

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function notification():BelongsTo
    {
        return $this->belongsTo(PushNotification::class);
    }
}
