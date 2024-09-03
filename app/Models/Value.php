<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $table = 'values';
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    protected $guarded = [];
}
