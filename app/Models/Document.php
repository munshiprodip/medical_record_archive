<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hn',
        'an',
        'file_path',
        'department_id',
        'doctor_id',
        'ward_id',
        'is_dead',
        'is_police_case',
        'status',
        'created_by',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, "department_id");
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, "doctor_id");
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, "ward_id");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by");
    }
}
