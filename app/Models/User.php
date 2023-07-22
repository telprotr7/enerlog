<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'nik',
        'no_wa',
        'tempat_lahir',
        'tanggal_lahir',
        'image',
        'is_active',
        'role',
        'password',
        'status_login',
        'is_login',
        'user_time_login'
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function userAgent()
    // {
    //     return $this->hasOne(MSession::class);
    // }

    // public function menus(): BelongsToMany
    // {
    //     return $this->belongsToMany(Menu::class, 'menu_user', 'user_id', 'menu_id')
    //         ->withPivot('status')
    //         ->withTimestamps();
    // }

    // public function submenus(): BelongsToMany
    // {
    //     return $this->belongsToMany(Submenu::class, 'menu_user', 'user_id', 'menu_id')
    //         ->withPivot('status')
    //         ->withTimestamps();
    // }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task', 'user_id', 'task_id');
    }
}
