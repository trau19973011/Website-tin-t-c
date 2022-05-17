<?php
	
	class Comment_Controller extends Base_Controller
	{
		function index()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}

			// Phân trang
			$total_record = $this->model->binhluan->count_rows(['xetduyet' => '= 1']);
			$this->library->pagination->init([
				'current_page' => getParameter('page') ? getParameter('page') : 1,
				'total_record' => $total_record,
				'limit' => 10,
				'link_full' => base_url('comment/index?page={page}'),
				'link_first' => base_url('comment/index'),
				'range' => 5
			]);
			$limit = $this->library->pagination->get('limit');
			$start = $this->library->pagination->get('start');
			$page = $this->library->pagination->html();

			$comments = $this->model->binhluan->list_comment($start,$limit);
			$this->view->load('comment/index', ['comments' => $comments, 'page' => $page]);
		}
	}