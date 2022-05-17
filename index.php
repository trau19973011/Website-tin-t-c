<?php
	session_start();
    define('BASE_PATH', __DIR__);
    define('APP_PATH', BASE_PATH . '/app/frontend');
    define('BASE_URL', 'http://localhost:8080/webtintuc');

    require BASE_PATH . '/core/Common.php';
    load_app();
