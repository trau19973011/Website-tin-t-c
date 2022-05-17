<?php
	
	class Category_Controller extends Base_Controller
	{
		function index()
		{	
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}

			// Phân trang
			$total_record = $this->model->chuyenmuc->count_rows();
			$this->library->pagination->init([
				'current_page' => getParameter('page') ? getParameter('page') : 1,
				'total_record' => $total_record,
				'limit' => 10,
				'link_full' => base_url('category/index?page={page}'),
				'link_first' => base_url('category/index'),
				'range' => 5
			]);
			$limit = $this->library->pagination->get('limit');
			$start = $this->library->pagination->get('start');
			$page = $this->library->pagination->html();

			$categories = $this->model->chuyenmuc->find_all([],'vitri asc', "$start,$limit");
			$this->view->load('category/index', ['categories' => $categories, 'page' => $page]);	
		}

		function add()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}
			$error = $this->add_cate();
			$this->view->load('category/add', ['error' => $error]);
		}
		function search()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}
			$data = $this->search_cate();
			$this->view->load('category/search', ['data' => $data]);
		}

		function edit()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}
			$id_cate = (int)getParameter('id');
			$cate = $this->model->chuyenmuc->find_by_id(['id_cate' => $id_cate]);
			if(!$cate)
			{
				redirect('category/index');
			}
			$error = $this->edit_cate($id_cate);
			$this->view->load('category/edit',['cate' => $cate, 'error' => $error]);
		}

		function edit_cate($id_cate)
		{
			$error = [];
			if(isset($_POST['submit']) && $_POST['submit'] == 'edit_cate')
			{
				$cate = postParameter('cate');
				$cate1 = postParameter('cate1');
				$vitri = postParameter('vitri');
				$status = postParameter('status');

				if(empty($cate) || strlen($cate) < 3 || strlen($cate) > 30)
				{
					$error['cate'] = '<div class="alert alert-danger">Chuyên mục không hợp lệ, phải từ 3 - 30 kí tự</div>';
				}

				if($vitri < 1 || $vitri > 999)
				{
					$error['vitri'] = '<div class="alert alert-danger">Vị trí không hợp lệ, phải từ 1 (tối đa 3 chữ số)</div>';
				}

				if(!$error)
				{
					if($cate1 == $cate)
					{
						$edit = $this->model->chuyenmuc->update(['vitri' => $vitri, 'trangthai' => $status], "id_cate = {$id_cate}");
						if($edit)
						{
							echo "<script> alert('Sửa thành công'); window.location.assign('". base_url('category/index') ."'); </script>";
							exit();
						}
					}
					else
					{
						$check_cate = $this->model->chuyenmuc->select('ten',['ten' => "= '".$cate."'"]);
						if($check_cate)
						{
							$error['cate'] = '<div class="alert alert-danger">Chuyên mục đã tồn tại</div>';
						}
						else
						{
							$edit = $this->model->chuyenmuc->update(['ten' => $cate, 'vitri' => $vitri, 'trangthai' => $status], "id_cate = {$id_cate}");
							if($edit)
							{
								echo "<script> alert('Sửa thành công'); window.location.assign('". base_url('category/index') ."'); </script>";
								exit();
							}
						}
					}
				}
			}
			return $error;
		}
		// function
		function search_cate()
		{
			$data = [];
			$search = getParameter('s');

			if(!$search)
			{
				$data['error'] = '<div class="alert alert-warning">Không tìm thấy kết quả</div>';
			}

			if(!$data)
			{
				$total_record = $this->model->chuyenmuc->count_rows_search($search);
				if(!$total_record)
				{
					$data['error'] = '<div class="alert alert-warning">Không tìm thấy kết quả</div>';
				}
				else
				{
					// Phân trang
					$this->library->pagination->init([
						'current_page' => getParameter('page') ? getParameter('page') : 1,
						'total_record' => $total_record,
						'limit' => 10,
						'link_full' => base_url("category/search?s={$search}&page={page}"),
						'link_first' => base_url("category/search?s={$search}"),
						'range' => 5
					]);
					$limit = $this->library->pagination->get('limit');
					$start = $this->library->pagination->get('start');
					$data['page'] = $this->library->pagination->html();

					$data['categories'] = $this->model->chuyenmuc->search_cate($search,$start,$limit);
				}
			}
			return $data;
		}

		//function
		function add_cate()
		{
			$error = [];
			if(isset($_POST['submit']) && $_POST['submit'] == 'add_cate')
			{
				$cate = postParameter('cate');
				$vitri = (int)postParameter('vitri');

				if(empty($cate) || strlen($cate) < 3 || strlen($cate) > 30)
				{
					$error['cate'] = '<div class="alert alert-danger">Chuyên mục không hợp lệ, phải từ 3 - 30 kí tự</div>';
				}

				if($vitri < 1 || $vitri > 999)
				{
					$error['vitri'] = '<div class="alert alert-danger">Vị trí không hợp lệ, phải từ 1 (tối đa 3 chữ số)</div>';
				}

				if(!$error)
				{
					$check_cate = $this->model->chuyenmuc->select('ten',['ten' => "= '".$cate."'"]);
					if($check_cate)
					{
						$error['cate'] = '<div class="alert alert-danger">Chuyên mục đã tồn tại</div>';
					}
					else
					{
						$add = $this->model->chuyenmuc->insert(['ten' => $cate, 'vitri' => $vitri]);
						if($add)
						{
							redirect('category/index');
						}
					}
				}


			}
			return $error;
		}
	}