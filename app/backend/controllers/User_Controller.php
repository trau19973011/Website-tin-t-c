<?php
	
	class User_Controller extends Base_Controller
	{
		function index()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}
			// Phân trang
			$total_record = $this->model->taikhoan->count_rows(['level' => '!= '. 3]);
			$this->library->pagination->init([
				'current_page' => getParameter('page') ? getParameter('page') : 1,
				'total_record' => $total_record,
				'limit' => 10,
				'link_full' => base_url("user/index?page={page}"),
				'link_first' => base_url("user/index"),
				'range' => 5,
			]);
			$limit = $this->library->pagination->get('limit');
			$start = $this->library->pagination->get('start');
			$page = $this->library->pagination->html();

			$users = $this->model->taikhoan->list_user($start, $limit);

			$this->view->load('user/index', ['page' => $page, 'users' => $users]);
		}

		function search()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}
			$data = $this->search_user();
			$this->view->load('user/search', ['data' => $data]);
		}

		function edit()
		{
			if($_SESSION['level'] != 3)
			{
				redirect('home/index');
			}

			$id_user = (int)getParameter('id');
			$user = $this->model->taikhoan->find_by_id(['id_user' => $id_user]);
			if(!$user)
			{
				redirect('user/index');
			}
			$data = $this->edit_user($id_user);
			$this->view->load('user/edit', ['user' => $user, 'data' => $data]);
		}

		// function edit user
		function edit_user($id)
		{
			$data = [];

			if(isset($_POST['submit']))
			{
				$status = postParameter('status');
				$tenhienthi = postParameter('tenhienthi');
				$dienthoai = postParameter('sodt');
				$email = postParameter('email');
				$matkhau = postParameter('pass');

				if(!preg_match('/^[a-zA-Z\s]{3,32}$/', $tenhienthi))
				{
					$data['err_tenhienthi'] = '<label class="label label-danger">Tên hiển thị không hợp lệ</label>';
				}
				if(!preg_match('/^[0][78935]([0-9]{8})$/', $dienthoai))
				{
					$data['err_sodt'] = '<label class="label label-danger">Số điện thoại không hợp lệ</label>';
				}
				if(!preg_match('/^([a-z0-9.]{3,50})@([a-z]+)\.([a-z]+)$/', $email))
				{
					$data['err_email'] = '<label class="label label-danger">Email không hợp lệ</label>';
				}

				if(!$data)
				{
					if(!$matkhau)
					{
						$edit = $this->model->taikhoan->update(['dienthoai' => $dienthoai, 'email' => $email, 'tenhienthi' => $tenhienthi, 'level' => $status], "id_user = $id");
						if($edit)
						{
							echo "<script> alert('Sửa thành công'); window.location.assign('". base_url('user/index') ."'); </script>";
							exit();

						}
					}
					else
					{
						if(!preg_match('/^[\w\W]{6,50}$/', $matkhau))
						{
							$data['err_pass'] = '<label class="label label-warning">Mật khẩu không hợp lệ</label>';
						}

						if(!$data)
						{
							$edit = $this->model->taikhoan->update(['matkhau' => $matkhau, 'dienthoai' => $dienthoai, 'email' => $email, 'tenhienthi' => $tenhienthi, 'level' => $status], "id_user = $id");
							if($edit)
							{
								echo "<script> alert('Sửa thành công'); window.location.assign('". base_url('user/index') ."'); </script>";
								exit();
							}
						}
					}
				}
			}
			return $data;
		}
		// function tim kiem user
		function search_user()
		{
			$data = [];
			$search = getParameter('s');

			if(!$search)
			{
				$data['error'] = '<div class="alert alert-warning">Không tìm thấy kết quả</div>';
			}

			if(!$data)
			{
				//Phân trang
				$total_record = $this->model->taikhoan->count_rows_search($search);
				if(!$total_record)
				{
					$data['error'] = '<div class="alert alert-warning">Không tìm thấy kết quả</div>';
				}
				else
				{
					$this->library->pagination->init([
						'current_page' => getParameter('page') ? getParameter('page') : 1,
						'total_record' => $total_record,
						'limit' => 10,
						'link_full' => base_url("user/search?s={$search}&page={page}"),
						'link_first' => base_url("user/search?s={$search}"),
						'range' => 5
					]);

					$limit = $this->library->pagination->get('limit');
					$start = $this->library->pagination->get('start');
					$data['page'] = $this->library->pagination->html();

					$data['users'] = $this->model->taikhoan->search_user($search,$start,$limit);
				}
			}

			return $data;
		}
	}