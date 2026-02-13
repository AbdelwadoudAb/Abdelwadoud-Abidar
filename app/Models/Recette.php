<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'temps_preparation', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
