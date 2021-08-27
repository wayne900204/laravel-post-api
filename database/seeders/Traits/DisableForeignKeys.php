<?php


namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys
{
    // 關閉外鍵檢查
    protected function disableForeignKey()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }
    // 開啟外鍵檢查
    protected function enableForeignKey()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
