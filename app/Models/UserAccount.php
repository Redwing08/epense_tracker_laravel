<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    // Explicitly bind to the custom database table
    protected $table = 'user_accounts';

    // Mass assignable fields matching your migration & controller
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'md5password',
        'image',
    ];

    // Hide sensitive fields when serialized (e.g., for future API endpoints)
    protected $hidden = [
        'md5password',
    ];
}