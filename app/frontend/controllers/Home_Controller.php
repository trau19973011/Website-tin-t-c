<?php
	
	class Home_Controller extends Base_Controller
	{
		function index()
		{
			// Load 5 tin xem nhiều nhất trong ngày
			$hot_news = $this->model->tintuc->find_all(['date(ngaytao)' => '= date(now())', 'xetduyet' => '= 2'], 'luotxem DESC', 5);

			// Load tin mới nhất
			$news = $this->model->tintuc->find_all(['xetduyet' => '= 2'], 'id_news DESC', 8);
			$this->view->load('templates/tinmoinhat', ['news' => $news, 'hot_news' => $hot_news]);
			$tinmoinhat = $this->view->show('tinmoinhat');

			// Load tin dành cho bạn
			$news1 = $this->model->tintuc->tin_trongtuan();
			$this->view->load('templates/danhchoban', ['news1' => $news1]);
			$danhchoban = $this->view->show('danhchoban');

			// Load tin theo chuyên mục
			$tinchuyenmuc = [];
			$chuyenmuc = $this->model->chuyenmuc->find_all(['trangthai' => '= 2'], 'vitri asc', 8);
			foreach($chuyenmuc as $value)
			{
				$tinchuyenmuc[$value['ten']] = $this->model->tintuc->tin_chuyenmuc($value['id_cate'], 0, 3);
			}
			$this->view->load('templates/tinchuyenmuc', ['tinchuyenmuc' => $tinchuyenmuc]);
			$tincm = $this->view->show('tinchuyenmuc');

			// Load content
			$this->view->load('home/index', ['tinmoinhat' => $tinmoinhat, 'danhchoban' => $danhchoban, 'tincm' => $tincm]);
		}
	}