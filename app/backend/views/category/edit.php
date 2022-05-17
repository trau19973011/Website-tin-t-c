<a href="<?php echo base_url('category/index'); ?>" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 

<p class="form-edit-cate">
        <form method="POST" id="formEditCate" class="formAlert">
            <div class="form-group">
                <label>Trạng thái</label>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="1" <?php if($cate['trangthai'] == 1) echo 'checked'; ?>> Ẩn
                	</label>
                </div>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="2" <?php if($cate['trangthai'] == 2) echo 'checked'; ?>> Hiện
                	</label>
                </div>
            </div>
             <div class="form-group">
                <label>Tên chuyên mục</label>
                <input type="text" class="form-control" value="<?php echo $cate['ten']; ?>" name="cate">
                <input type="hidden" class="form-control" value="<?php echo $cate['ten']; ?>" name="cate1">
                <?php echo isset($error['cate']) ? $error['cate'] : ''; ?>
            </div>
            <div class="form-group">
                <label>Vị trí hiển thị</label> 
                <input type="text" class="form-control" value="<?php echo $cate['vitri']; ?>" name="vitri">
                <?php echo isset($error['vitri']) ? $cate['vitri'] : ''; ?>  
            </div>         
            <div class="form-group">
                <button type="submit" name="submit" value="edit_cate" class="btn btn-primary">Lưu thay đổi</button>
            </div>
            <div class="alert alert-danger hidden"></div>
        </form>
    </p>