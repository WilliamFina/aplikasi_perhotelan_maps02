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
                Ubah Data Wisata
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart() ?>
                <input type="hidden" name="id_wisata" value="<?php echo $wisata['id_wisata'] ?>">
                <div class="form-group">
                    <label>Nama Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" value="<?php echo $wisata['nama_wisata'] ?>">
                    <?php echo form_error('nama_wisata', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>latitude</label>
                    <input type="text" name="latitude" class="form-control" value="<?php echo $wisata['latitude'] ?>" readonly>
                    <?php echo form_error('latitude', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>longitude</label>
                    <input type="text" name="longitude" class="form-control" value="<?php echo $wisata['longitude'] ?>" readonly>
                    <?php echo form_error('longitude', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"><?php echo $wisata['alamat'] ?></textarea>
                    <?php echo form_error('alamat', '<div class="text-danger">', '</div>') ?>
                </div>
                <div class=" form-group">
                    <label>Foto Wisata</label>
                    <?php if ($wisata['foto'] != null) : ?>
                        <div class="mb-5 text-muted">
                            <img src="<?php echo base_url('template/images/' . $wisata['foto']) ?>" style="width:100px; height:auto;">
                            <p><?php echo $wisata['foto'] ?></p>
                        </div>
                    <?php endif ?>
                    <input type="file" name="foto" class="form-control">
                    <div class="text-muted">(Biarkan kosong jika tidak ingin diganti)</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                    <a href="<?php echo base_url('admin/wisata') ?>" class="btn btn-danger btn-sm">Batal</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>