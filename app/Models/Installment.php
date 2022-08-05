<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = ['value','date','active','financial_id'];

    public function financial() {
        return $this->belongsTo(Financial::class);
    }
}
