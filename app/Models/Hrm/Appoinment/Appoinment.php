<?php

namespace App\Models\Hrm\Appoinment;

use App\Models\User;
use App\Models\Visit\VisitImage;
use App\Models\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CoreApp\Traits\DateHandler;
use App\Helpers\CoreApp\Traits\TimeDurationTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Hrm\Appoinment\AppoinmentParticipant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\coreApp\Traits\Relationship\StatusRelationTrait;

class Appoinment extends Model
{
    use HasFactory, StatusRelationTrait, DateHandler,TimeDurationTrait;

    public function visitImages()
    {
        return $this->morphOne(VisitImage::class, 'imageable')->latestOfMany();
    }
    public function createdBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function appoinmentWith():BelongsTo
    {
        return $this->belongsTo(User::class, 'appoinment_with');
    }
    public function participants():HasMany
    {
        return $this->hasMany(AppoinmentParticipant::class);
    }
    public function otherParticipant()
    {
        return $this->belongsTo(AppoinmentParticipant::class,'appoinment_with','participant_id');
    }

    public function partnerInfo(){
        $partner=[];
        foreach ($this->participants as $key => $participant) {
            if($participant->participantInfo->id != auth()->user()->id){
                $partner=[
                    'name'=>$participant->participantInfo->name,
                    'is_agree'=>$participant->is_agree == 1 ? 'Agree' : 'Disagree',
                    'is_present'=>$participant->is_present == 1 ? 'Present' : 'Absent',
                    'present_at'=> ShowDate($participant->present_at).', '.$this->timeFormatInPlainText($participant->present_at),
                    'appoinment_started_at'=>$this->timeFormatInPlainText($participant->appoinment_started_at),
                    'appoinment_ended_at'=>$this->timeFormatInPlainText($participant->appoinment_ended_at),
                    'appoinment_duration'=>$participant->appoinment_duration,
                
                ];
            }
        }
        return $partner;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($appoinment) { 
             $appoinment->participants()->delete();
        });
    }
}
