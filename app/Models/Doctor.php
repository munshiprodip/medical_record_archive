<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'speciality_id',
        'status',
        'created_by',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, "speciality_id");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by");
    }
}
