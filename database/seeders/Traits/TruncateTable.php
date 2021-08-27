<?php


namespace Database\Seeders\Traits;


use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    //刪除 table 表格裡的所有資料
    protected function truncate($table)
    {
        // 刪除 table 表格裡的所有資料
        DB::table($table)->truncate();
    }
}
