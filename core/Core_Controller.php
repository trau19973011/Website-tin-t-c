<?php 
	
	class Core_Controller
	{
		protected $layout;
		protected $model;
		protected $view;
		protected $helper;
		protected $library;
		protected $title = 'Trang chủ';
		function __construct()
		{
			// Load Layout;
			require BASE_PATH . '/core/loaders/Layout_Loader.php';
			$this->layout = new Layout_Loader();

			// Load View;
			require BASE_PATH . '/core/loaders/View_Loader.php';
			$this->view = new View_Loader();

			// Load Model;
			require BASE_PATH . '/core/loaders/Model_Loader.php';
			$this->model = new Model_Loader();

			// Load Helper;
			require BASE_PATH . '/core/loaders/Helper_Loader.php';
			$this->helper = new Helper_Loader();

			// Load Library;
			require BASE_PATH . '/core/loaders/Library_Loader.php';
			$this->library = new Library_Loader();

			// Auto load helper, model, library
			$this->autoload();
		}

		function autoload()
		{
			$config = require BASE_PATH . '/config/autoload.php';

			foreach ($config as $autoload => $names)
			{
				foreach ($names as  $name) 
				{
					$this->$autoload->load($name);
				}
			}
		}
	}