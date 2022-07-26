<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

	protected $fillable = ['full_name', 'age', 'birthdate', 'department'];
}
