<?php
	
	class News_Controller extends Base_Controller
	{
		// Danh sách bài viết
		function index()
		{

			if($_SESSION['level'] == 3)
			{
				// Phân trang
				$total_record = $this->model->tintuc->count_rows();
				$this->library->pagination->init([
					'current_page' => getParameter('page') ? getParameter('page') : 1,
					'total_record' => $total_record,
					'limit' => 10,
					'link_full' => base_url("news/index?page={page}"),
					'link_first' => base_url("news/index"),
					'range' => 5
				]);
				$limit = $this->library->pagination->get('limit');
				$start = $this->library->pagination->get('start');
				$page = $this->library->pagination->html();
				$news = $this->model->tintuc->list_news($start,$limit);
			}
			elseif($_SESSION['level'] == 2)
			{
				// Phân trang
				$total_record = $this->model->tintuc->count_rows(['id_user' => '= '.$_SESSION['id_user']]);
				$this->library->pagination->init([
					'current_page' => getParameter('page') ? getParameter('page') : 1,
					'total_record' => $total_record,
					'limit' => 10,
					'link_full' => base_url("news/index?page={page}"),
					'link_first' => base_url("news/index"),
					'range' => 5
				]);
				$limit = $this->library->pagination->get('limit');
				$start = $this->library->pagination->get('start');
				$page = $this->library->pagination->html();
				$news = $this->model->tintuc->list_news($start,$limit, $_SESSION['id_user']);
			}

			$this->view->load('news/index', ['news' => $news, 'page' => $page]);
		}

		// Thêm bài viết
		function add()
		{
			$error = $this->add_news();
			$cate = $this->model->chuyenmuc->find_all(['trangthai' => '= 2'],'vitri asc', 8);
			$this->view->load('news/add', ['error' => $error, 'cate' => $cate]);
		}

		// Tìm kiếm bài viết
		function search()
		{
			$data = $this->search_news();
			$this->view->load('news/search', ['data' => $data]);
		}

		// Sửa bài viết
		function edit()
		{
			$id = (int)getParameter('id');
			if($_SESSION['level'] == 3)
			{
				$news = $this->model->tintuc->find_by_id(['id_news' => $id]);
				if(!$news)
				{
					redirect('news/index');
				}
			}
			elseif ($_SESSION['level'] == 2) 
			{
				$news = $this->model->tintuc->find_by_id(['id_news' => $id, 'id_user' => $_SESSION['id_user']]);
				if(!$news)
				{
					redirect('news/index');
				}
			}
			// Sửa bài viết
			$error = $this->edit_news($id);
			//Load chuyên mục
			$cate = $this->model->chuyenmuc->find_all(['trangthai' => '= 2'],'vitri asc', 8);

			$this->view->load('news/edit', ['news' => $news, 'cate' => $cate, 'error' => $error]);
		}

		function upload()
		{
			$id = (int)getParameter('id');
			if($_SESSION['level'] == 3)
			{
				$news = $this->model->tintuc->select('id_news', ['id_news' => '= '.$id]);
				if(!$news)
				{
					redirect('news/index');
				}
			}
			elseif ($_SESSION['level'] == 2) 
			{
				$news = $this->model->tintuc->select('id_news', ['id_user' => '= '.$_SESSION['id_user'], 'id_news' => '= '.$id]);
				if(!$news)
				{
					redirect('news/index');
				}
			}
			// Upload ảnh
			$error = $this->upload_img($id);
			$images = $this->model->hinhanh->find_all(['id_news' => '= '.$id],'id_img desc');
			$this->view->load('news/upload', ['images' => $images, 'error' => $error]);
		}



		/* ******* */

		// function upload ảnh
		function upload_img($id)
		{
			$error = [];
			if(isset($_FILES['img_up']))
			{
			
				if($_FILES['img_up']['error'][0] == 0)
				{
					if(count($_FILES['img_up']['name']) > 10)
					{
						$error['soluong'] = 'Số lượng ảnh không hợp lệ';
					}

					// Kiểm tra size ảnh
					$size = '';
					foreach ($_FILES['img_up']['size'] as $key => $value) 
					{
						if($value > 5242880)
						{
							$size .= ", {$_FILES['img_up']['name'][$key]}";
						}
					}
					if($size)
					{
						$error['size'] = trim($size, ',') . ' vượt quá 5MB';
					} 

					//Kiểm tra đuôi ảnh
					$type = '';
					foreach ($_FILES['img_up']['type'] as $key => $value) 
					{
						if($value != 'image/png' && $value != 'image/jpeg' && $value != 'image/gif')
						{
							$type .= ", {$_FILES['img_up']['name'][$key]}";
						}
					}
					if($type)
					{
						$error['type'] = trim($type, ',') . ' sai định dạng ảnh';
					} 

					// Nếu k lỗi
					if(!$error)
					{
						//Upload ảnh
						foreach($_FILES['img_up']['name'] as $name => $value)
						{
							$img_name = $_FILES['img_up']['name'][$name];
							$img_tmpname = $_FILES['img_up']['tmp_name'][$name];

							$type = $_FILES['img_up']['type'][$name];
							$size = $_FILES['img_up']['size'][$name];

							$path_name = BASE_PATH . '/img/' . $img_name;
							$check = move_uploaded_file($img_tmpname, $path_name);
							if($check)
							{
								$this->model->hinhanh->insert(['url' => 'img/' . $img_name,
									'type' => $type,
									'size' => $size,
									'id_news' => $id,
									'id_user' => $_SESSION['id_user']
								]);
							}
						}
						redirect("news/upload?id={$id}");
					}
				}
				else
				{
					$error['soluong'] = 'Số lượng ảnh không hợp lệ';
				}

			}
			return $error;
		}
		// function sửa bài viết
		function edit_news($id)
		{
			$data = [];

			if(isset($_POST['submit']))
			{
				$tieude = postParameter('title');
				$xetduyet = postParameter('status',1);
				$mota = postParameter('mota');
				$logo = postParameter('logo');
				$cate = postParameter('cate');
				$noidung = postParameter('noidung');

				$url = str_replace('admin.php', '', BASE_URL);
				$logo = str_replace("http://localhost:8080/webtintuc/", '', $logo);
				if(!preg_match('/^[\w\W]{6,150}$/', $tieude))
				{
					$data['title'] = '<div class="alert alert-danger">Tiêu đề không hợp lệ, không được bỏ trống và phải từ 6 - 150 kí tự</div>';
				}
				if(!preg_match('/^[\w\W]{6,300}$/', $mota))
				{
					$data['mota'] = '<div class="alert alert-danger">Mô tả không hợp lệ, không được bỏ trống và phải từ 6 - 300 kí tự</div>';
				}					
				if(!preg_match('/^[\w\W]{15,}$/', $noidung))
				{
					$data['noidung'] = '<div class="alert alert-danger">Nội dung không hợp lệ, không được bỏ trống và phải từ 6 kí tự trở lên</div>';
				}	
				if(!file_exists(BASE_PATH . '/'.$logo))
				{
					$data['logo'] = '<div class="alert alert-danger">Đường dẫn ảnh không hợp lệ, không được bỏ trống và cần phải tải lên</div>';
				}

				if(!$data)
				{

					$update = $this->model->tintuc->update(['tieude' => $tieude, 'mota' => $mota, 'logo' => $logo, 'noidung' => $noidung, 'xetduyet' => $xetduyet], "id_news = {$id}");
					if($update)
					{

						echo '<script> alert("Sửa thành công"); window.location.assign("'. base_url("news/index") .'")</script>';
						exit();
					}
				}
			}

			return $data;
		}
		// function tìm kiếm bài viết
		function search_news()
		{
			$data = [];
			$module = getParameter('module');
			$action = getParameter('action');
			if($module == 'news' && $action == 'search')
			{
				$search = getParameter('s');

				if(empty($search))
				{
					$data['error'] = '<div class="alert alert-warning" style="margin-top: 12px"> Không tìm thấy kết quả </div>';
				}

				if(!$data)
				{
					if($_SESSION['level'] == 3)
					{
						$total_record = $this->model->tintuc->count_rows_search($search);
						if(!$total_record)
						{
							$data['error'] = '<div class="alert alert-warning" style="margin-top: 12px"> Không tìm thấy kết quả </div>';
						}
						else
						{
							// Phân trang
							$this->library->pagination->init([
								'current_page' => getParameter('page') ? getParameter('page') : 1,
								'total_record' => $total_record,
								'limit' => 10,
								'link_full' => base_url("news/search?s={$search}&page={page}"),
								'link_first' => base_url("news/search?s={$search}"),
								'range' => 5
							]);

							$data['page'] = $this->library->pagination->html();
							$limit = $this->library->pagination->get('limit');
							$start = $this->library->pagination->get('start');
		
							$data['news'] = $this->model->tintuc->search($search,$start,$limit);
						}
					}
					elseif($_SESSION['level'] == 2)
					{
						$total_record = $this->model->tintuc->count_rows_search($search, "tintuc.id_user = {$_SESSION['id_user']}");
						
						if(!$total_record)
						{
							$data['error'] = '<div class="alert alert-warning" style="margin-top: 12px"> Không tìm thấy kết quả </div>';
						}
						else
						{
							// Phân trang
							$this->library->pagination->init([
								'current_page' => getParameter('page') ? getParameter('page') : 1,
								'total_record' => $total_record,
								'limit' => 10,
								'link_full' => base_url("news/search?s={$search}&page={page}"),
								'link_first' => base_url("news/search?s={$search}"),
								'range' => 5
							]);

							$data['page'] = $this->library->pagination->html();
							$limit = $this->library->pagination->get('limit');
							$start = $this->library->pagination->get('start');
		
							$data['news'] = $this->model->tintuc->search($search,$start,$limit, "tintuc.id_user = {$_SESSION['id_user']}");
						}
					}
					
				}
			}
			return $data;
		}
		// function thêm bài viết
		function add_news()
		{
			$error = [];
			if(isset($_POST['submit']))
			{
				$title = postParameter('title');
				$id_cate = postParameter('id_cate');
				if(!preg_match('/^[\w\W]{6,100}$/', $title))
				{
					$error['title'] = 'Tiêu đề không hợp lệ, không được bỏ trống và phải từ 6 - 100 kí tự';
				}
				if(!$error)
				{
					$check = $this->model->tintuc->insert(['tieude' => $title,
					 'mota' => '',
					 'logo' => '',
					 'noidung' => '',
					 'id_user' => $_SESSION['id_user'],
					 'id_cate' => $id_cate
					]);

					if($check)
					{
						redirect('news/index');
					}
				}
			}

			return $error;
		}
	}