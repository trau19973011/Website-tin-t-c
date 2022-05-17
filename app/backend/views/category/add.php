 <a href="<?php echo base_url('category/index'); ?>" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 
<p class="form-add-cate">
    <form method="POST" id="formAddCate" enctype="multipart/form-data" class="formAlert">
        <div class="form-group">
            <label>Tên chuyên mục</label>
            <input type="text" class="form-control" name="cate">
            <?php echo isset($error['cate']) ? $error['cate'] : ''; ?>
        </div>        
        <div class="form-group">
            <label>Vị trí hiện</label>
            <input type="text" class="form-control" name="vitri">
            <?php echo isset($error['vitri']) ? $error['vitri'] : ''; ?>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" value="add_cate" class="btn btn-primary">Tạo</button>
        </div>
        <div class="alert alert-danger hidden"></div>
    </form>
</p>  