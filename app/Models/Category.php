<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // $guarded untuk melarang field apa saja yang tidak boleh diisi
    protected $guarded = ['id'];

    public function posts(): HasMany{
        return $this->hasMany(Post::class);
    }

public function getRouteKeyName()
    {
        return 'slug';
    }
}
