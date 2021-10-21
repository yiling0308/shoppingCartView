<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'aff_agent';

    protected $fillable = ['id', 'aff_code', 'agent_account', 'password', 'parent_id', 'name', 'mail', 'withdraw_password', 'phone', 'group_id', 'agent_level', 'comment', 'status', 'login_at', 'created_at', 'updated_at'];
}
