<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b><?php echo $hotel['nama_hotel'] ?></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo base_url('operator/home/ganti_password_aksi/' . $hotel['id_hotel']) ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username_hotel" class="form-control" value="<?php echo $hotel['username_hotel'] ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password_hotel" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

                </form>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>