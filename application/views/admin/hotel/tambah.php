<div class="row">
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Lokasi Hotel
            </div>
            <div class="panel-body">
                <?php echo $map['html'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Tambah Data Hotel
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart() ?>
                <div class="form-group">
                    <label>Nama Hotel</label>
                    <input type="text" name="nama_hotel" class="form-control" value="<?php echo set_value('nama_hotel') ?>">
                    <?php echo form_error('nama_hotel', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>latitude</label>
                    <input type="text" name="latitude" class="form-control" readonly>
                    <?php echo form_error('latitude', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>longitude</label>
                    <input type="text" name="longitude" class="form-control" readonly>
                    <?php echo form_error('longitude', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="number" name="no_telepon" class="form-control" value="<?php echo set_value('no_telepon') ?>">
                    <?php echo form_error('no_telepon', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Username Hotel</label>
                    <input type="text" name="username_hotel" class="form-control" value="<?php echo set_value('username_hotel') ?>">
                    <?php echo form_error('username_hotel', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class=" form-group">
                    <label>Password Hotel</label>
                    <input type="password" name="password_hotel" class="form-control">
                    <?php echo form_error('password_hotel', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"><?php echo set_value('alamat') ?></textarea>
                    <?php echo form_error('alamat', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class=" form-group">
                    <label>Jumlah Kamar</label>
                    <input type="number" name="jumlah_kamar" class="form-control">
                    <?php echo form_error('jumlah_kamar', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class=" form-group">
                    <label>Foto Hotel</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    <a href="<?php echo base_url('admin/hotel') ?>" class="btn btn-danger btn-sm">Batal</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>