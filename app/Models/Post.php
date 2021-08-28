<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'body' => 'array'
    ];


    /**
     * mutator 允許我們轉換模組屬性的函數
     * 1. Accessor 用於讀取轉換職
     * 2. mutator 將值存入資料庫之前，轉換值
     * 假設我們現在要將 title 的值轉成大寫再存入資料庫
     * 參考文獻 => https://learnku.com/docs/laravel/5.7/eloquent-mutators/2297#defining-an-accessor
     * 讀取資料的時候轉換
     * 此為 Accessor function 名稱必須為 getXXXXAttribute
     * php artisan tinker
     * \App\Models\Post::find(1)->title_upper_case
     */
    // 此為 Accessor function 名稱必須為 getXXXXAttribute
    // php artisan tinker
    // \App\Models\Post::find(1)->title_upper_case
    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
    }
    // 存入資料庫前轉換
    /*
     * ```shell
     * php artisan tinker
     * $post = \App\Models\Post::find(1)
     * $post->title = 'HEYYYAAA'
     * $post
     * ```
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    // 這邊建立一個 comments，要記得加 s 因為這是一對多， post 裡面的 id 對應 comments 裡面的 post_id
    // 如果你有 php seed 放入假資料的話，你的 comments 裡面的留言都會在 post_id = 1 底下。因此我們可以使用
    // php artisan tinker，這個指令，可以讓你輸入一段程式碼去執行，並把執行結果直接打印到終端機上面去。
    // 再次下   \App\Models\Post::find(1)->comments   ，這個指令會去 Comments 表格裡面找 post_id = 1 的值，因出來在 terminal
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    // 這邊建立一個 users，要記得加 s 因為這是多對多
    // 對應 users table,  foreignPivotKey is post_id, relatedPivotKey is user_id
    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
