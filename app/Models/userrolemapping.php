<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userrolemapping extends Model
{
    use HasFactory;
    protected $table='userrolemappings';
    protected $fillable = [
        'userId',
        'roleId'
    ];
}
