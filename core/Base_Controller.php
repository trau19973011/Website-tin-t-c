<?php
	
	Class Base_Controller extends Core_Controller
	{
		function renderLayout()
		{
			// Load content
			$content = $this->view->show('content');

			// Frontend
			if(!strpos(APP_PATH, 'backend'))
			{
				// Load menu
				$categories = $this->model->chuyenmuc->find_all(['trangthai' => '= 2'], 'vitri asc', 8);
				$this->view->load('templates/menu', ['categories' => $categories]);
				$menu = $this->view->show('menu');

				// Load footer
				$this->view->load('templates/footer');
				$footer = $this->view->show('footer');

				// Lấy title
				$title = $this->title;
			}

			$this->layout->load([
				'content' => $content,
				'menu' => isset($menu) ? $menu : '',
				'footer' => isset($footer) ? $footer : '',
				'title' => isset($title) ? $title : 'Quản trị'
			]);
		}

		function __destruct()
		{
			$this->renderLayout();
		}
	}