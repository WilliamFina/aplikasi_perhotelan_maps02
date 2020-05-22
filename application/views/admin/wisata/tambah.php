<div class="row">
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Lokasi Wisata
            </div>
            <div class="panel-body">
                <?php echo $map['html'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Tambah Data Wisata
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart() ?>
                <div class="form-group">
                    <label>Nama Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" value="<?php echo set_value('nama_wisata') ?>">
                    <?php echo form_error('nama_wisata', '<div class="text-danger">', '</div>') ?>
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
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"><?php echo set_value('alamat') ?></textarea>
                    <?php echo form_error('alamat', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class=" form-group">
                    <label>Foto Wisata</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                    <a href="<?php echo base_url('admin/wisata') ?>" class="btn btn-danger btn-sm">Batal</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>