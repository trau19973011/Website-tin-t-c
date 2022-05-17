<?php
	
	Class Pagination_Library
	{
		protected $config = [
			'current_page' => 1, // Trang hiện tại
			'total_record' => 1, // Tổng số record
			'total_page' => 1, // Tổng số trang
			'limit' => 10, // Limit
			'start' => 0, // Start
			'link_full' => '', // Link full
			'link_first' => '', // Link trang đầu tiên
			'range' => '', // Số trang muốn hiển thị
			'range' => '', // Số trang muốn hiển thị
			'min' => 0,
			'max' => 0,
		];

		function init($config = [])
		{
			// Gán lại các giá trị mặc định
			foreach ($config as $key => $value)
			{
				if(isset($this->config[$key]))
				{
					$this->config[$key] = $value;
				}
			}

			// Kiểm tra limit
			if($this->config['limit'] < 0)
			{
				$this->config['limit'] = 0;
			}

			// Tính tổng số trang
			$this->config['total_page'] = ceil($this->config['total_record'] / $this->config['limit']);

			if(!$this->config['total_page'])
			{
				$this->config['total_page'] = 1;
			}

			// Kiểm tra trang hiện tại
			// Nếu trang hiện tại < 1
			if($this->config['current_page'] < 1)
			{
				$this->config['current_page'] = 1;
			}
			// Nếu trang hiện tại > total_page
			if($this->config['current_page'] > $this->config['total_page'])
			{
				$this->config['current_page'] = $this->config['total_page'];
			}

			// Tính start
			$this->config['start'] = ($this->config['current_page'] - 1) * $this->config['limit'];

			// Tính middle
			$middle = ceil($this->config['range'] / 2);

			// Tính min, max
			if($this->config['total_page'] < $this->config['range'])
			{
				$this->config['min'] = 1;
				$this->config['max'] = $this->config['total_page'];
			}
			else
			{
				$this->config['min'] = $this->config['current_page'] - $middle + 1;
				$this->config['max'] = $this->config['current_page'] + $middle - 1;

				if($this->config['min'] < 1)
				{
					$this->config['min'] = 1;
					$this->config['max'] = $this->config['range'];
				}
				elseif($this->config['max'] > $this->config['total_page'])
				{
					$this->config['min'] = $this->config['total_page'] - $this->config['range'] + 1;
					$this->config['max'] = $this->config['total_page'];
				}
			}
		}

		// Hàm lấy link
		private function __link($page)
		{
			if($page <= 1 && $this->config['link_first'])
			{
				return $this->config['link_first'];
			}

			return str_replace('{page}', $page, $this->config['link_full']);
		}

		function html()
		{
			$p = '';

			if($this->config['total_record'] > $this->config['limit'])
			{
				$p .= '<nav aria-label="Page navigation">';
				$p .= '<ul class="pagination">';

				// Nút Prev và First
				if($this->config['current_page'] > 1)
				{
					$p .= '<li><a href="'. $this->__link(1) .'"> First </a></li>';
					$p .= '<li><a href="'. $this->__link($this->config['current_page'] - 1) .'">   <span aria-hidden="true">&laquo;</span> </a></li>';
				}

				// Hiển thị các nút từ min -> max
				for($i = $this->config['min']; $i <= $this->config['max']; $i++)
				{
					if($this->config['current_page'] == $i)
					{
						$p .= '<li class="active"><span>' . $i . '</span></li>';
					}
					else
					{
						$p .= '<li><a href="'. $this->__link($i) .'">' . $i . '</a></li>';
					}
				}

				// Nút Next và Last
				if($this->config['current_page'] < $this->config['total_page'])
				{
				
					$p .= '<li><a href="'. $this->__link($this->config['current_page'] + 1) .'"><span aria-hidden="true">&raquo;</span> </a></li>';
					$p .= '<li><a href="'. $this->__link($this->config['total_page']) .'"> Last </a></li>';
				}

				$p .= '</ul>';
				$p .= '</nav>';
			}

			return $p;
		}

		function get($key)
		{
			return $this->config[$key];
		}
	}