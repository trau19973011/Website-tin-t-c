<?php
	session_start();

	if(!isset($_SESSION['level']) || $_SESSION['level'] == 1)
	{
		header('location: index.php');
		exit();
	}

    define('BASE_PATH', __DIR__);
    define('APP_PATH', BASE_PATH . '/app/backend');
    define('BASE_URL', 'http://localhost:8080/webtintuc/admin.php');

    require BASE_PATH . '/core/Common.php';
    load_app();
