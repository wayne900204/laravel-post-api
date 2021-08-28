<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $casts = [
        'body' => 'array'
    ];
    // 這邊建立一個 post，  多對一  ， post 裡面的 id 對應 comments 裡面的 post_id
    // 如果你有 php seed 放入假資料的話，你的 comments 裡面的留言都會在 post_id = 1 底下。因此我們可以使用
    // php artisan tinker，這個指令，可以讓你輸入一段程式碼去執行，並把執行結果直接打印到終端機上面去。
    // 再次下   \App\Models\Comment::find(1)->post   ，會印出來在 terminal
    public function post(){
        return $this->belongsTo(Post::class,"post_id");
    }
}
