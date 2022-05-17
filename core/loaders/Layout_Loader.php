<?php 
	
	class Layout_Loader
	{
		protected $layout = 'default';

		function setLayout($layout)
		{
			$this->layout = $layout;
		}

		function load($data = [])
		{
			extract($data);

			$layout_path = APP_PATH . "/views/layout/{$this->layout}.php";

			if(!file_exists($layout_path))
			{
				exit("File not found $layout_path");
			}

			require $layout_path;
		}
	}