# laravel-db-config

> 基于laravel5.1.*以上版本的系统数据库读写配置文件。

## 安装

1. 安装包文件

  ```shell
  composer require jani/laravel-db-config
  ```

## 配置

### Laravel 应用

1. 注册 `ServiceProvider`:

  ```php
  Jani\DbConfig\DbConfigServiceProvider::class,
  ```

2. 创建配置文件：

  ```shell
  php artisan vendor:publish
  ```

3. 请修改应用根目录下的 `config/db_config.php` 中对应的项即可；

4. （可选）添加外观到 `config/app.php` 中的 `aliases` 部分:

  ```php
  'DbConfig' =>Jani\DbConfig\Facades\DbConfigFacades::class,
  ```

5.使用

  ```php
  /*
  *可以是个string字符串或array字符串群发
  */
  \DbConfig::set('key','value');
  \DbConfig::get('key','default_value');
  \DbConfig::delete('key');
  ```
  
## License

无
