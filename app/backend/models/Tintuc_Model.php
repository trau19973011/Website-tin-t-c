<?php 
	
	class Tintuc_Model extends Base_Model
	{
		protected $table = 'tintuc';

		function list_news($start, $limit, $id_user = 0)
		{
			$where = '';
			if($id_user)
			{
				$where = " WHERE tintuc.id_user = {$id_user}";
			}
			$query = "SELECT * FROM {$this->table} INNER JOIN taikhoan ON tintuc.id_user = taikhoan.id_user INNER JOIN chuyenmuc ON tintuc.id_cate = chuyenmuc.id_cate" . $where . " ORDER BY xetduyet ASC, id_news DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function count_rows_search($search, $and = null)
		{
			$a = '';
			if($and)
			{
				$a = " AND {$and}";
			}
			$query = "select count(*) FROM {$this->table} INNER JOIN taikhoan ON tintuc.id_user = taikhoan.id_user WHERE (tieude LIKE :search OR tenhienthi LIKE :search OR id_news LIKE :search)".$a;
		
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = (int)$sth->fetchColumn(); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function search($search, $start, $limit, $and = null)
		{
			$a = '';
			if($and)
			{
				$a = " AND {$and} ";
			}

			$query = "SELECT * FROM {$this->table} INNER JOIN taikhoan ON tintuc.id_user = taikhoan.id_user INNER JOIN chuyenmuc ON tintuc.id_cate = chuyenmuc.id_cate WHERE (tieude LIKE :search OR tenhienthi LIKE :search OR id_news LIKE :search)" . $a . "ORDER BY id_news DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => "%$search%"]); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
	}