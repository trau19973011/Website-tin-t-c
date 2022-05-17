 <a href="<?php echo base_url('news/add'); ?>" class="btn btn-default">
 	<span class="glyphicon glyphicon-plus"></span> Thêm
 </a>

 <a href="<?php echo base_url('news/index'); ?>" class="btn btn-default">
 	<span class="glyphicon glyphicon-repeat"></span> Reload
 </a> 

 <a class="btn btn-danger" id="del_post_list">
 	<span class="glyphicon glyphicon-trash"></span> Xoá
 </a>

 <!--  Form tìm kiếm bài viết -->
 <p>
 	<form id="formSearchPost" >
 		<div class="input-group">
 		 	<input type="hidden" name="module" value="news">
 			<input type="hidden" name="action" value="search">         
 			<input type="text" class="form-control" name="s" placeholder="Nhập ID, tiêu đề, tác giả...">
 			<span class="input-group-btn">
 				<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
 			</span>
 		</div>
 	</form>
 </p> 

<!--  Danh sách bài viết -->
 <?php if($news) { ?>
 <div class="table-responsive" id="list_post">
 	<table class="table table-striped list">
 		<tr>
 			<td><input type="checkbox"></td>
 			<td><strong>ID</strong></td>
 			<td><strong>Tiêu đề</strong></td>
 			<td><strong>Trạng thái</strong></td>
 			<td><strong>Chuyên mục</strong></td>
 			<td><strong>Lượt xem</strong></td>
 			<td><strong>Tác giả</strong></td>
 			<td><strong>Tools</strong></td>
 		</tr>
 		<?php foreach($news as $new): ?>
 		<?php 
 			if($new['xetduyet'] == 1)
 			{
 				$xetduyet = '<label class="label label-warning">Chưa duyệt</label>';
 			}
 			elseif ($new['xetduyet'] == 2) 
 			{
 				$xetduyet = '<label class="label label-success">Đã duyệt</label>';
 			}
 		?>		
 		<tr>
 			<td><input type="checkbox" name="id_news[]" value="<?php echo $new['id_news']; ?>"></td>
 			<td><?php echo $new['id_news']; ?></td>
 			<td width="30%"><a href="<?php echo base_url("news/edit?id={$new['id_news']}"); ?>"><?php echo $new['tieude']; ?></a></td>
 			<td><?php echo $xetduyet; ?></td>
 			<td><?php echo $new['ten']; ?></td>
 			<td><?php echo $new['luotxem']; ?></td>
 			<td><?php echo $new['tenhienthi']; ?></td>
 			<td>
 				<a href="<?php echo base_url("news/edit?id={$new['id_news']}"); ?>" class="btn btn-primary btn-sm">
 					<span class="glyphicon glyphicon-edit"></span>
 				</a>
 				<a class="btn btn-danger btn-sm del-post-list" data-id="<?php echo $new['id_news']; ?>">
 					<span class="glyphicon glyphicon-trash"></span>
 				</a>
 			</td>
 		</tr>
 	   <?php endforeach; ?>
 	</table>
 	 <?php echo $page; ?>
 </div>

 <?php } else echo '<div class="alert alert-danger"> Không có bài viết nào</div>'; ?>