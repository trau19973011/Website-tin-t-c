 <a href="<?php echo base_url('news/index'); ?>" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 
<p class="form-add-post">
    <form method="POST" id="formAddPost" enctype="multipart/form-data" class="formAlert">
        <div class="form-group">
            <label>Tiêu đề bài viết</label>
            <input type="text" class="form-control" name="title">
        </div>        
        <div class="form-group">
            <label>Chuyên mục</label>
            <select name="id_cate" class="form-control">
                <?php foreach($cate as $value): ?>
                <option value="<?php echo $value['id_cate']; ?>"><?php echo $value['ten']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
            if(isset($error['title']))
            {
         ?>              
        <div class="form-group alert alert-danger">
            <?php echo $error['title']; ?>
        </div>
        <?php } ?>
        <div class="form-group">
            <button type="submit" name="submit" value="ok" class="btn btn-primary">Tạo</button>
        </div>
        <div class="alert alert-danger hidden"></div>
    </form>
</p>  