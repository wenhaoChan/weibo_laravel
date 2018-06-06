<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 2018/6/6
 * Time: 下午2:38
 */

function get_db_config()
{
    /*
     * Heroku 生成的 DATABASE_URL 包含了一切与数据库相关的配置信息
     * 如主机、用户名、密码、数据库等，
     * 使用 parse_url 方法对其进行解析，来获取到指定的值。
     * */
    if(getenv('IS_IN_HEROKU')) {
        $url = parse_url(getenv('DATABASE_URL'));

        return $db_config = [
            'connection' => 'pgsql',
            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ];
    }
}