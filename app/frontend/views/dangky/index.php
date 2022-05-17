<div class="container">
    <div class="col-xs-12 col-sm-3 col-sm-offset-3">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo tài khoản</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên Tài Khoản</label>
                            <input type="text" class="form-control" name="user" value="<?php echo isset($_POST['user']) ? $_POST['user'] : ''; ?>">
                            <span style="color: red"><?php echo isset($data['err_user']) ? $data['err_user'] : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="pass" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>">
                            <span style="color: red"><?php echo isset($data['err_pass']) ? $data['err_pass'] : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            <span style="color: red"><?php echo isset($data['err_email']) ? $data['err_email'] : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Điện thoại</label>
                            <input type="text" class="form-control"  name="sodt" value="<?php echo isset($_POST['sodt']) ? $_POST['sodt'] : ''; ?>">
                            <span style="color: red"><?php echo isset($data['err_sodt']) ? $data['err_sodt'] : ''; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input type="text" class="form-control" name="tenhienthi" value="<?php echo isset($_POST['tenhienthi']) ? $_POST['tenhienthi'] : ''; ?>">
                            <span style="color: red"><?php echo isset($data['err_tenhienthi']) ? $data['err_tenhienthi'] : ''; ?></span>
                        </div>
                        <?php 
                            if(isset($data['success']))
                            {
                                echo "<div class='alert alert-success' style='padding: 28px; font-size:14px'> {$data['success']} </div>";
                            }
                         ?>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Tạo tài khoản" name="ok">
                        <input type="reset" class="btn btn-default" data-dismiss="modal" value="Hủy bỏ">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>