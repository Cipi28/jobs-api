<?php

/**
 * Parse Heroku Database url
 */
if (env("DATABASE_URL", false)) {
    // parse db url
    $url = parse_url(env("DATABASE_URL"));
    $host = $url["host"];
    $port = array_key_exists('port', $url) ? $url["port"] : null;
    $username = $url["user"];
    $password = array_key_exists('pass', $url) ? $url["pass"] : '';
    $database = substr($url["path"], 1);
} else {
    $host = env('DB_HOST', 'localhost');
    $port = env('DB_PORT', null);
    $database = env('DB_DATABASE', 'forge');
    $username = env('DB_USERNAME', 'forge');
    $password = env('DB_PASSWORD', '');
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => $host,
            'port' => $port ?: 5432,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => env('DB_PREFIX', ''),
            'schema' => env('DB_SCHEMA', 'public'),
            'sslmode' => env('DB_SSL_MODE', 'prefer'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

//    'redis' => [
//
//        'client' => 'predis',
//
//        'cluster' => $redisCluster,
//
//        'default' => [
//            'host' => $redisHost,
//            'password' => $redisPassword,
//            'port' => $redisPort,
//            'database' => env('REDIS_DATABASE', 0),
//        ],
//
//        'cache' => [
//            'host' => $redisHost,
//            'password' => $redisPassword,
//            'port' => $redisPort,
//            'database' => env('REDIS_CACHE_DB', 1),
//        ],
//
//    ],

];
