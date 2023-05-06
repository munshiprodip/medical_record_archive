<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'path',
        'active_status',
        'created_by',
    ];
}