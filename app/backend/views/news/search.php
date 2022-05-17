<!--  Danh sách bài viết -->
<a href="<?php echo base_url('news/index'); ?>" class="btn btn-default" style="margin-bottom: 12px">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 
 <a class="btn btn-danger" id="del_post_list" style="margin-bottom: 12px">
 	<span class="glyphicon glyphicon-trash"></span> Xoá
 </a>
 <?php if(isset($data['news'])) { ?>
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
 		<?php foreach($data['news'] as $new): ?>
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
 			<td><input type="checkbox"></td>
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
 	 <?php echo $data['page']; ?>
 </div>

 <?php } else echo isset($data['error']) ? $data['error'] : ''; ?>