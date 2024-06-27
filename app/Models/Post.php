<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hearts() {
        return $this->belongsToMany(User::class, 'hearts');
    }

    public function ressource()
    {
        return $this->belongsTo(Ressource::class);
    }
}
