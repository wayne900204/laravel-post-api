<?php

namespace Database\Seeders;

use App\Models\Post;
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
//        這面的 state([  這邊可以 overwrite factory 的 fake data to default data  ])
//        Post::factory(3)->state(['title' => 'untitle'])->create();
        Post::factory(3)->untitled()->create();
        $this->enableForeignKey();
    }
}
