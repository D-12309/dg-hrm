<?php

namespace App\Models\Finance;

use App\Models\User;
use App\Models\Finance\Account;
use App\Models\coreApp\Status\Status;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expenses\IncomeExpenseCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function type()
    {
        return $this->belongsTo(Status::class, 'transaction_type');
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

   
}
