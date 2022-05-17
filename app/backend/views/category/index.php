 <a href="<?php echo base_url('category/add'); ?>" class="btn btn-default">
 	<span class="glyphicon glyphicon-plus"></span> Thêm
 </a>

 <a href="<?php echo base_url('category/index'); ?>" class="btn btn-default">
 	<span class="glyphicon glyphicon-repeat"></span> Reload
 </a> 

 <a class="btn btn-danger" id="del_cate_list">
 	<span class="glyphicon glyphicon-trash"></span> Xoá
 </a>

 <!--  Form tìm kiếm chuyên mục -->
 <p>
 	<form id="formSearchCate" >
 		<div class="input-group">
 		 	<input type="hidden" name="module" value="category">
 			<input type="hidden" name="action" value="search">         
 			<input type="text" class="form-control" name="s" placeholder="Nhập ID, tên chuyên mục ...">
 			<span class="input-group-btn">
 				<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
 			</span>
 		</div>
 	</form>
 </p> 
<!--  Danh sách chuyên mục -->
 <?php if($categories) { ?>
 <div class="table-responsive" id="list_post">
 	<table class="table table-striped list">
 		<tr>
 			<td><input type="checkbox"></td>
 			<td><strong>ID</strong></td>
 			<td><strong>Tên chuyên mục</strong></td>
 			<td><strong>Vị trí</strong></td>
 			<td><strong>Trạng thái</strong></td>
 			<td><strong>Tools</strong></td>
 		</tr>
 		<?php 
 			foreach($categories as $cate):
 			if($cate['trangthai'] == 1)
 			{
 				$status = '<label class="label label-warning">Ẩn</label>';
 			}
 			elseif($cate['trangthai'] == 2)
 			{
 				$status = '<label class="label label-success">Hiện</label>';
 			}
 		?>
 		<tr>
 			<td><input type="checkbox" name="id_cate[]" value="<?php echo $cate['id_cate']; ?>"></td>
 			<td><?php echo $cate['id_cate']; ?></td>
 			<td><a href="<?php echo base_url("category/edit?id={$cate['id_cate']}"); ?>"><?php echo $cate['ten']; ?></a></td>
 			<td><?php echo $cate['vitri']; ?></td>
 			<td><?php echo $status; ?></td>
 			<td>
 				<a href="<?php echo base_url("category/edit?id={$cate['id_cate']}"); ?>" class="btn btn-primary btn-sm">
 					<span class="glyphicon glyphicon-edit"></span>
 				</a>
 				<a class="btn btn-danger btn-sm del-cate" data-id="<?php echo $cate['id_cate']; ?>">
 					<span class="glyphicon glyphicon-trash"></span>
 				</a>
 			</td>
 		</tr>
 	   <?php endforeach; ?>
 	</table>
 	 <?php echo $page; ?>
 </div>

 <?php } else echo '<div class="alert alert-danger"> Không có chuyên mục nào</div>'; ?>