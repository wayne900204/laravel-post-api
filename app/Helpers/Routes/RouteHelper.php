<?php


namespace App\Helpers\Routes;


class RouteHelper
{
    /**
     * 用來讀取某個資料夾底下的全部 php 檔案。
     * @param string $folder
     */
    public static function includeRouteFiles(string $folder)
    {
        // １個 . 代表是子元件， 2 個 . 代表 is父元件
        $dirIterator = new \RecursiveDirectoryIterator($folder);
        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new \RecursiveIteratorIterator($dirIterator);
        // required the file in each iteration

        while ($it->valid()) {
            if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
//                require $it->current()->getPath();
            }
            $it->next();
        }
    }
}
