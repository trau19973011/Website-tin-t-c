<a href="<?php echo base_url('category/index'); ?>" class="btn btn-default" style="margin-bottom: 12px">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 
<a class="btn btn-danger" id="del_cate_list" style="margin-bottom: 12px">
 	<span class="glyphicon glyphicon-trash"></span> Xoá
</a>

<?php if(isset($data['categories'])) { ?>
 <div class="table-responsive" id="list_user">
 	<table class="table table-striped list">
 		<tr>
 			<td><input type="checkbox"></td>
 			<td><strong>ID</strong></td>
 			<td><strong>Tên chuyên mục</strong></td>
 			<td><strong>Vị trí</strong></td>
 			<td><strong>Trạng thái</strong></td>
 			<td><strong>Tools</strong></td>
 		</tr>
 		<?php foreach($data['categories'] as $cate): ?>
 		<?php 
 			if($cate['trangthai'] == 1)
 			{
 				$status = '<label class="label label-warning">Ẩn</label>';
 			}
 			elseif ($cate['trangthai'] == 2) 
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
 	 <?php echo $data['page']; ?>
 </div>

 <?php } else echo isset($data['error']) ? $data['error'] : ''; ?>