<?php

namespace App\Models;

use App\Models\User;
use App\Models\Traits\CompanyTrait;
use App\Models\PushNotificationUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PushNotification extends Model
{
    use HasFactory,CompanyTrait;

    public function users():HasMany
    {
        return $this->hasMany(PushNotificationUser::class);
    }
    public function notifyBy():BelongsTo
    {
        return $this->belongsTo(User::class,'notify_by','id');
    }
}
