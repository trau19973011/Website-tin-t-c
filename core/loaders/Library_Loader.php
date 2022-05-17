<?php
	
	class Library_Loader
	{
		function load($lib_name)
		{
			$lib = ucfirst($lib_name) . '_Library';
			$lib_path = BASE_PATH . "/core/libraries/{$lib}.php";

			if(!file_exists($lib_path))
			{
				exit("File not found $lib_path");
			}

			require $lib_path;

			$this->$lib_name = new $lib;
		}
	}