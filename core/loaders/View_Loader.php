<?php 
	
	class View_Loader
	{
		protected $content = [];

		function load($view, $data = [])
		{
			extract($data);

			$view_path = APP_PATH . "/views/{$view}.php";

			if(!file_exists($view_path))
			{
				exit("File not found $view_path");
			}

			$view_arr = explode('/', $view);

			if($view_arr[0] != 'templates')
			{
				$view_name = 'content';
			}
			else
			{
				$view_name = $view_arr[1];
			}
			ob_start();
			require $view_path;
			$this->content[$view_name] = ob_get_contents();
			ob_end_clean();
		}

		function show($key)
		{
			if(isset($this->content[$key]))
			{
				return $this->content[$key];
			}
			return false;
		}

	}