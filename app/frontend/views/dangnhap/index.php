  <div class="container">
    <div class="col-xs-12 col-sm-3 col-sm-offset-3 login">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="formAlert">
                    <div class="modal-header">
                        <h4 class="modal-title">Đăng nhập</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên Tài Khoản</label>
                            <input type="text" class="form-control"  name="user">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control"  name="pass">
                        </div>
                        <?php
                            if(isset($data['error']))
                            {
                                echo '<div class="alert alert-danger" style="font-size: 14px">' . $data['error'] . '</div>';
                            }
                         ?>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Đăng nhập" name="ok" style="margin-right: 250px">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>