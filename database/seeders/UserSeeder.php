<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//      限制每次最多 10 筆資料
//      因為有啟用外來鍵檢查，因此不法 truncate table，因此在此要關閉外來件檢查
//      DB::statement('SET FOREIGN_KEY_CHECKS=0');
//      DB::table('users')->truncate();// 刪除 users 表格裡的所有資料
//      DB::statement('SET FOREIGN_KEY_CHECKS=1');
//      開啟外來件檢查。

        $this->disableForeignKey();
        $this->truncate('users');
        User::factory(10)->create();
        $this->enableForeignKey();

    }
}
