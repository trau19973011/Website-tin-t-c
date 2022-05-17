<div style="margin-bottom: 12px">
<a href="<?php echo base_url('comment/index'); ?>" class="btn btn-default">
	<span class="glyphicon glyphicon-repeat"></span> Reload
</a> 
<a class="btn btn-success" id="accept_comment_list">
	<span class="glyphicon glyphicon-ok"></span> Duyệt
</a>
<a class="btn btn-danger" id="del_comment_list">
	<span class="glyphicon glyphicon-trash"></span> Xoá
</a>
</div>
<!--  Danh sách comment -->
 <?php if($comments) { ?>
 <div class="table-responsive" id="list_post" >
 	<table class="table table-striped list">
 		<tr>
 			<td><input type="checkbox"></td>
 			<td><strong>ID</strong></td>
 			<td><strong>Nội dung bình luận</strong></td>
 			<td><strong>Bài viết</strong></td>
 			<td><strong>Trạng thái</strong></td>
 			<td><strong>Người bình luận</strong></td>
 			<td><strong>Tools</strong></td>
 		</tr>
 		<?php 
 			foreach($comments as $comment):
 			$url = str_replace('admin.php', '', base_url("news/detail?id={$comment['id_news']}")); 
 			if($comment['xetduyet'] == 1)
 			{
 				$status = '<label class="label label-warning">Chưa duyệt</label>';
 			}
 		?>
 		<tr>
 			<td><input type="checkbox" name="id_cm[]" value="<?php echo $comment['id_cm']; ?>"></td>
 			<td><?php echo $comment['id_cm']; ?></td>
 			<td width="28%"><?php echo $comment['noidung']; ?></td>
 			<td width="30%"><a href="<?php echo $url; ?>" target="_blank"><?php echo $comment['tieude']; ?></a></td>
 			<td><?php echo $status; ?></td>
 			<td style="text-align: center; width: 15%"><?php echo $comment['tenhienthi']; ?></td>
 			<td width="10%">
 				<a class="btn btn-success btn-sm accept-comment" data-id="<?php echo $comment['id_cm']; ?>">
 					<span class="glyphicon glyphicon-ok"></span>
 				</a>
 				<a class="btn btn-danger btn-sm del-comment" data-id="<?php echo $comment['id_cm']; ?>">
 					<span class="glyphicon glyphicon-trash"></span>
 				</a>
 			</td>
 		</tr>
 	   <?php endforeach; ?>
 	</table>
 	 <?php echo $page; ?>
 </div>

 <?php } else echo '<div class="alert alert-warning"> Không có bình luận nào</div>'; ?>