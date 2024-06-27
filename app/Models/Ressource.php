<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Ressources are files that can be uploaded. they can be imagem video, pdf, md, etc.
class Ressource extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'type', 'name'];
}
