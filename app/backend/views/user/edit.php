<a href="<?php echo base_url('user/index'); ?>" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
</a> 

<p class="form-edit-user">
        <form method="POST" id="formEditUser" class="formAlert">
            <div class="form-group">
                <label>Phân quyền</label>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="1" <?php if($user['level'] == 1) echo 'checked'; ?>> Thành viên
                	</label>
                </div>
                <div class="radio">
                	<label>
                		<input type="radio" name="status" value="2" <?php if($user['level'] == 2) echo 'checked'; ?>> Tác giả
                	</label>
                </div>
            </div>
             <div class="form-group">
                <label>Tên hiển thị</label> <?php echo isset($data['err_tenhienthi']) ? $data['err_tenhienthi'] : ''; ?>
                <input type="text" class="form-control" value="<?php echo $user['tenhienthi']; ?>" name="tenhienthi">
            </div>
            <div class="form-group">
                <label>Điện thoại</label> <?php echo isset($data['err_sodt']) ? $data['err_sodt'] : ''; ?>
                <input type="text" class="form-control" value="<?php echo $user['dienthoai']; ?>" name="sodt">  
            </div>
            <div class="form-group">
                <label>Email</label> <?php echo isset($data['err_email']) ? $data['err_email'] : ''; ?>
                <input type="text" class="form-control" value="<?php echo $user['email']; ?>" name="email"> 
            </div>             
            <div class="form-group">
                <label>Mật khẩu mới</label> <?php echo isset($data['err_pass']) ? $data['err_pass'] : ''; ?>
                <input type="password" class="form-control" value="" name="pass">              
            </div>            
            <div class="form-group">
                <button type="submit" name="submit" value="ok" class="btn btn-primary">Lưu thay đổi</button>
            </div>
            <div class="alert alert-danger hidden"></div>
        </form>
    </p>