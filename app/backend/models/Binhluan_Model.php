<?php
	
	class Binhluan_Model extends Base_Model
	{
		protected $table = 'binhluan';

		function list_comment($start,$limit)
		{
			$query = "SELECT id_cm, binhluan.noidung, tieude, binhluan.xetduyet, tenhienthi, binhluan.id_news FROM {$this->table} INNER JOIN taikhoan ON binhluan.id_user = taikhoan.id_user INNER JOIN tintuc ON binhluan.id_news = tintuc.id_news WHERE binhluan.xetduyet = 1 ORDER BY id_cm DESC LIMIT $start,$limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

	}