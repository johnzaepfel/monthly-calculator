<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class); 
    }

    protected $fillable = [
        'name',
        'order',
        'budget_total',
    ];

}

