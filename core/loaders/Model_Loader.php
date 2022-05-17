<?php 
	
	class Model_Loader
	{
		function load($model)
		{
			$model_name = ucfirst($model) . '_Model';
			$model_path = APP_PATH . "/models/{$model_name}.php";

			if(!file_exists($model_path))
			{
				exit("File not found $model_path");
			}

			require $model_path;
			
			$this->$model = new $model_name;
		}
	}