<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'aff_customer';

    protected $fillable = ['id', 'aid', 'user_id', 'username', 'add_time', 'created_at', 'updated_at'];
}
