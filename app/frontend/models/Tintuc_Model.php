<?php 
	
	class Tintuc_Model extends Base_Model
	{
		protected $table = 'tintuc';

		function tin_chuyenmuc($id_cate, $start, $limit)
		{
			$query = "SELECT * FROM {$this->table} WHERE id_cate = :id_cate AND xetduyet = 2 ORDER BY id_news DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['id_cate' => $id_cate]); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function tin_trongtuan()
		{
			$query = "SELECT * FROM {$this->table} INNER JOIN chuyenmuc ON tintuc.id_cate = chuyenmuc.id_cate WHERE weekofyear(now()) = weekofyear(ngaytao) AND xetduyet = 2 ORDER BY luotxem DESC LIMIT 8";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function tin_lienquan($id, $id_cate)
		{
			$query = "SELECT * FROM {$this->table} WHERE id_cate = :id_cate AND id_news != :id AND xetduyet = 2 ORDER BY RAND() LIMIT 4";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['id_cate' => $id_cate, 'id' => $id]); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function search($search, $start, $limit)
		{
			$query = "SELECT * FROM {$this->table} INNER JOIN taikhoan ON tintuc.id_user = taikhoan.id_user INNER JOIN chuyenmuc ON tintuc.id_cate = chuyenmuc.id_cate WHERE (tieude LIKE :search OR tenhienthi LIKE :search) AND xetduyet = 2 ORDER BY id_news DESC LIMIT $start, $limit";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => "%$search%"]); // Thuc thi query
			$data = $sth->fetchAll(PDO::FETCH_ASSOC); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}

		function count_rows_search($search)
		{
			$query = "select count(*) FROM {$this->table} INNER JOIN taikhoan ON tintuc.id_user = taikhoan.id_user WHERE (tieude LIKE :search OR tenhienthi LIKE :search) AND xetduyet = 2";
			$sth = $this->db->prepare($query); // Chuan bi query
			$sth->execute(['search' => '%'.$search.'%']); // Thuc thi query
			$data = (int)$sth->fetchColumn(); // Lấy nhiều bản ghi
			$sth->closeCursor(); // Đóng kết nối
			return $data;
		}
	}