<?php
	
	function base_url($uri)
	{
		$uri = str_replace('?', '&', $uri);

		$uri_arr = explode('/', $uri);

		$module = $uri_arr[0];
		$action = $uri_arr[1];

		return BASE_URL . "?module={$module}&action={$action}";
	}

	function getParameter($key, $default = 0)
	{
		if(!empty($_GET[$key]))
		{
			return $_GET[$key];
		}

		return $default;
	}

	function postParameter($key, $default = 0)
	{
		if(!empty($_POST[$key]))
		{
			return $_POST[$key];
		}

		return $default;
	}

	function redirect($uri)
	{
		$location = base_url($uri);

		header("location: {$location}");
		exit();
	}
