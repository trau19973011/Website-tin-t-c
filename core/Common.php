<?php
	
	function load_app()
	{
		$config = require BASE_PATH . '/config/config.php';
		$module = !empty($_GET['module']) ? $_GET['module'] : $config['default_module'];
		$action = !empty($_GET['action']) ? $_GET['action'] : $config['default_action'];

		$controller = ucfirst($module) . '_Controller';
		$controller_path = APP_PATH . "/controllers/{$controller}.php";

		// require core controller & base controller
		require BASE_PATH . '/core/Core_Controller.php';
		require BASE_PATH . '/core/Base_Controller.php';

		// require core model & base model
		require BASE_PATH . '/core/Core_Model.php';
		require BASE_PATH . '/core/Base_Model.php';
		
		if(!file_exists($controller_path))
		{
			exit("File not found $controller_path");
		}

		require $controller_path;

		if(!class_exists($controller))
		{
			exit("Class not found $controller");
		}

		$obj = new $controller;

		if(!method_exists($obj, $action))
		{
			exit("Method not found $action");
		}

		$obj->$action();
	}