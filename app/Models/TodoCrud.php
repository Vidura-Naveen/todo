<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoCrud extends Model
{
    use HasFactory;
    protected $table = 'todo_cruds';
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
