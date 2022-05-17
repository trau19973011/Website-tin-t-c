<a href="<?php echo base_url('user/index'); ?>" class="btn btn-default" style="margin-bottom: 12px">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a>
<a class="btn btn-danger" id="del_user_list" style="margin-bottom: 12px">
 	<span class="glyphicon glyphicon-trash"></span> Xoá
</a>
<?php if(isset($data['users'])) { ?>
 <div class="table-responsive" id="list_user">
 	<table class="table table-striped list">
 		<tr>
 			<td><input type="checkbox"></td>
 			<td><strong>ID</strong></td>
 			<td><strong>Tài khoản</strong></td>
 			<td><strong>Level</strong></td>
 			<td><strong>Điện thoại</strong></td>
 			<td><strong>Email</strong></td>
 			<td><strong>Tên hiển thị</strong></td>
 			<td><strong>Tools</strong></td>
 		</tr>
 		<?php foreach($data['users'] as $user): ?>
 		<?php 
 			if($user['level'] == 1)
 			{
 				$level = '<label class="label label-success">Thành viên</label>';
 			}
 			elseif ($user['level'] == 2) 
 			{
 				$level = '<label class="label label-info">Tác giả</label>';
 			}
 		?>		
 		<tr>
 			<td><input type="checkbox" name="id_user[]" value="<?php echo $user['id_user']; ?>"></td>
 			<td><?php echo $user['id_user']; ?></td>
 			<td><a href="<?php echo base_url("user/edit?id={$user['id_user']}"); ?>"><?php echo $user['taikhoan']; ?></a></td>
 			<td><?php echo $level; ?></td>
 			<td><?php echo $user['dienthoai']; ?></td>
 			<td><?php echo $user['email']; ?></td>
 			<td><?php echo $user['tenhienthi']; ?></td>
 			<td>
 				<a href="<?php echo base_url("user/edit?id={$user['id_user']}"); ?>" class="btn btn-primary btn-sm">
 					<span class="glyphicon glyphicon-edit"></span>
 				</a>
 				<a class="btn btn-danger btn-sm del-user" data-id="<?php echo $user['id_user']; ?>">
 					<span class="glyphicon glyphicon-trash"></span>
 				</a>
 			</td>
 		</tr>
 	   <?php endforeach; ?>
 	</table>
 	 <?php echo $data['page']; ?>
 </div>

 <?php } else echo isset($data['error']) ? $data['error'] : ''; ?>