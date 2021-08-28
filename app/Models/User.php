<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 這邊建立一個 users，要記得加 s 因為這是多對多
    // 對應 users table,  foreignPivotKey is post_id, relatedPivotKey is user_id
    public function posts(){
        return $this->belongsToMany(Post::class,'post_user','user_id','post_id');
    }
    /**https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
    /* User 的 belongsToMany 也寫完後，可以下
    /*
     * ```shell=
     * php artisan tinker
     * ```
     * ```php=
     * $user = \App\Models\User::find(1)
     * $relation = $user->posts()
     * $relation->attach(1)
     * $relation->attach([2,3])
     * $relation->detach(1)
     * $relation->toggle(1)
     * $releation->sync([1,2])
     * ```
     */
}
