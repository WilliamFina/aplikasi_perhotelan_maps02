<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b><?php echo $hotel['nama_hotel'] ?></b>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart() ?>
        <input type="hidden" name="id_tipe_kamar" value="<?php echo $tipe_kamar['id_tipe_kamar'] ?>">
        <div class="form-group">
            <label>Tipe Kamar</label>
            <input type="text" name="tipe_kamar" class="form-control" value="<?php echo $tipe_kamar['tipe_kamar'] ?>">
            <?php echo form_error('tipe_kamar', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class="form-group">
            <label>Harga Kamar</label>
            <input type="text" name="harga_kamar" class="form-control" value="<?php echo $tipe_kamar['harga_kamar'] ?>">
            <?php echo form_error('harga_kamar', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="3" class="form-control"><?php echo $tipe_kamar['keterangan'] ?></textarea>
            <?php echo form_error('keterangan', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class=" form-group">
            <label>Foto Hotel</label>
            <?php if ($tipe_kamar['foto_kamar'] != null) : ?>
                <div class="mb-5 text-muted">
                    <img src="<?php echo base_url('template/images/' . $tipe_kamar['foto_kamar']) ?>" style="width:100px; height:auto;">
                    <p><?php echo $tipe_kamar['foto_kamar'] ?></p>
                </div>
            <?php endif ?>
            <input type="file" name="foto_kamar" class="form-control">
            <div class="text-muted">(Biarkan kosong jika tidak ingin diganti)</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
            <a href="<?php echo base_url('operator/tipe_kamar/index/' . $hotel['id_hotel']) ?>" class="btn btn-danger btn-sm">Batal</a>
        </div>
        <?php echo form_close() ?>
    </div>
</div>