<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define relationship: One category has many expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id');
    }
}