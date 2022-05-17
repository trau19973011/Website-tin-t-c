<?php
	
	class Binhluan_Model extends Base_Model
	{
		protected $table = 'binhluan';

		function list_comment($id_news)
		{
			$query = "SELECT * FROM {$this->table} INNER JOIN taikhoan ON binhluan.id_user = taikhoan.id_user  WHERE id_news = :id_news AND xetduyet = 2 ORDER BY id_cm DESC";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['id_news' => $id_news]); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

	}