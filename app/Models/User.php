<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // $fillable untuk mengizinkan field apa saja yang boleh diisi
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    // $guarded untuk melarang field apa saja yang tidak boleh diisi
    // protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany{
        return $this->hasMany(Post::class, 'author_id');
        // kasih nama foreign keynya 'author_id'
        // karena laravel membacanya di table users user_id sama dengan user_id di table posts
        // akan tetapi di table posts adanya author_id yang berisi user_id 
    }
}
