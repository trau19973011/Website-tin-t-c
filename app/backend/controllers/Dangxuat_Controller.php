<?php
	
	class Dangxuat_Controller extends Base_Controller
	{
		function index()
		{
			session_destroy();
			header('location: index.php');
			exit();
		}
	}