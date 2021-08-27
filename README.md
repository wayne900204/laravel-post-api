# Laravel-Post-Api
開 Api 的心路歷程，將會在這裡記錄下來

 * 將你的 .env.example 複製到 ./，並命名為 .env
 * 創建資料庫
 * composer install
 * php artisan serve

## 指令
### 創建 Post、Comment 的 Model、Factory、Created、Seeder、Controller
```shell
php artisan make:model --help
php artisan make:model Comment --all --api
php artisan make:model Post --all --api
```
### 啟用 Seeders
```shell
php artisan db:seed
```
