<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'news';
    protected $fillable = [
        'title', 'content'
    ];
}
