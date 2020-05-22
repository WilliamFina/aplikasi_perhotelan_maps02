<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b><?php echo $hotel['nama_hotel'] ?></b>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart() ?>
        <input type="hidden" name="id_hotel" value="<?php echo $hotel['id_hotel'] ?>">
        <div class="form-group">
            <label>Tipe Kamar</label>
            <input type="text" name="tipe_kamar" class="form-control" value="<?php echo set_value('tipe_kamar') ?>">
            <?php echo form_error('tipe_kamar', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class="form-group">
            <label>Harga Kamar</label>
            <input type="text" name="harga_kamar" class="form-control" value="<?php echo set_value('harga_kamar') ?>">
            <?php echo form_error('harga_kamar', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="3" class="form-control"><?php echo set_value('keterangan') ?></textarea>
            <?php echo form_error('keterangan', '<div class="text-danger">', '</div>') ?>
        </div>
        <div class=" form-group">
            <label>Foto Kamar</label>
            <input type="file" name="foto_kamar" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
            <a href="<?php echo base_url('operator/tipe_kamar/index/' . $hotel['id_hotel']) ?>" class="btn btn-danger btn-sm">Batal</a>
        </div>
        <?php echo form_close() ?>
    </div>
</div>