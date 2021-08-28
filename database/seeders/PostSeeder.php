<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKey();
        $this->truncate('posts');
        //這面的 state([  這邊可以 overwrite factory 的 fake data to default data  ])
        //Post::factory(3)->state(['title' => 'untitle'])->create();
        $posts = Post::factory(3)
        //->has(Comment::factory(3),'comments')  // 這邊代表著，當我創立 Post 的時候，每一個 Post 的資料會產生 3 個關聯性資料表在 comments table 裡面
        //當我使用 has or for method 他會同時在 Post table and comments table 紀錄。因此會造成混亂。盡量少用
            ->untitled()
            ->create();
        // 多對多
        $posts->each(function (Post $post) {
            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]); // sync 是用來產生多對多的 method
        });
        $this->enableForeignKey();
    }
}
