<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;

use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'body'=>[],
            // 這邊是為了讓關聯的資料表可以取得 random，因此這邊把他提出去寫了一個 Helpers
            'user_id'=>FactoryHelper::getRandomModelId(User::class),
            'post_id'=>FactoryHelper::getRandomModelId(Post::class),
        ];
    }
}
