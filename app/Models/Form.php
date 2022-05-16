<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'forms';
    //Primary Key
    public $primaryKey = 'id';
    // Timestamps (default)
    public $timestamps = true;

   

}
