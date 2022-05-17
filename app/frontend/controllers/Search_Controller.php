<?php 
	
	class Search_Controller extends Base_Controller
	{
		function index()
		{
			$error = [];
			if(!empty($_GET['module']) && $_GET['module'] == 'search')
			{
				$search = !empty($_GET['s']) ? $_GET['s'] : '';

				if(empty($search))
				{
					$error['error'] = "Không tìm thấy kết quả";
				}

				if(!$error)
				{
					$total_record = $this->model->tintuc->count_rows_search($search);
					if(!$total_record)
					{
						$error['error'] = 'Không tìm thấy kết quả';
					}
					else
					{
						$this->library->pagination->init([
							'current_page' => getParameter('page') ? getParameter('page') : 1,
							'total_record' => $total_record,
							'limit' => 1,
							'link_full' => base_url("search/index?s={$search}&page={page}"),
							'link_first' => base_url("search/index?s={$search}"),
							'range' => 5,
						]);

						$limit = $this->library->pagination->get('limit');
						$start = $this->library->pagination->get('start');
						$page = $this->library->pagination->html();
						$news = $this->model->tintuc->search($search, $start, $limit);
					}
				}
			}
			// Gán title
			$this->title = 'Tìm kiếm';
			$this->view->load('search/index', ['error' => $error, 'news' => isset($news) ? $news : '', 'page' => isset($page) ? $page : '']);
		}
	}