<?php

namespace App\Models\Settings;

use App\Models\User;
use App\Models\coreApp\Status\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationBind extends Model
{
    use HasFactory;

    
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function IsOffice(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'is_office', 'id');
    }
}
