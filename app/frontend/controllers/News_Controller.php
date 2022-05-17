<?php
	
	class News_Controller extends Base_Controller
	{
		function index()
		{
			$id = (int)getParameter('id');
			// Phân trang
			$total_record = $this->model->tintuc->count_rows(['id_cate' => '= '.$id, 'xetduyet' => '= 2']);
			$pagination = $this->library->pagination->init([
				'current_page' => getParameter('page') ? getParameter('page') : 1,
				'total_record' => $total_record,
				'limit' => 1,
				'link_full' => base_url("news/index?id=$id&page={page}"),
				'link_first' => base_url("news/index?id=$id"),
				'range' => 3
			]);

			$limit = $this->library->pagination->get('limit');
			$start = $this->library->pagination->get('start');
			$page = $this->library->pagination->html();

			// Lấy tên chuyên mục
			$category = $this->model->chuyenmuc->find_by_id(['id_cate' => $id]);

			// Lấy title
			$this->title = $category ? $category['ten'] : 'Không xác định';

			// Load bài viết theo chuyên mục
			$news = $this->model->tintuc->tin_chuyenmuc($id, $start, $limit);

			// Load content
			$this->view->load('news/index', ['news' => $news, 'category' => $category, 'page' => $page]);
		}

		function detail()
		{
			$id = (int)getParameter('id');

			// Lấy bài viết theo id
			$news = $this->model->tintuc->find_by_id(['id_news' => $id]);

			// Update lượt xem
			if($news)
			{
				if(!isset($_COOKIE["id_{$id}"]))
				{
					setcookie("id_{$id}", true, time() + 600);
					$luotxem = $news['luotxem'];
					$this->model->tintuc->update(['luotxem' => $luotxem + 1], "id_news = {$news['id_news']}");
				}
			}

			// Lấy title
			$this->title = $news ? $news['tieude'] : 'Không xác định';
			
			// Lấy 4 tin liên quan
			$news1 = $this->model->tintuc->tin_lienquan($id, $news['id_cate']);

			// Lấy tên tác giả
			$tacgia = $this->model->taikhoan->find_by_id(['id_user' => $news['id_user']]);

			// Lấy danh sách comment
			$comments = $this->model->binhluan->list_comment($news['id_news']);

			$this->view->load('news/detail', ['news' => $news, 'news1' => $news1, 'tacgia' => $tacgia, 'comments' => $comments]);

		}

	}