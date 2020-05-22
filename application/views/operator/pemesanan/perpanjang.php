<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b>Perpanjang Pemesanan</b>
    </div>
    <div class="panel-body">
        <form action="" method="post">
            <input type="hidden" name="id_pemesan" value="<?php echo $pemesan['id_pemesan'] ?>">
            <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" value="<?php echo $pemesan['nama_pemesan'] ?>" readonly>
                <?php echo form_error('nama_pemesan', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_pemesan" class="form-control" value="<?php echo $pemesan['no_pemesan'] ?>" readonly>
                <?php echo form_error('no_pemesan', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat_pemesan" class="form-control" value="<?php echo $pemesan['alamat_pemesan'] ?>" readonly>
                <?php echo form_error('alamat_pemesan', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <label>Kamar</label>
                <input type="text" name="no_kamar" class="form-control" value=" No : <?php echo $kamar['no_kamar'] ?>" readonly>
                <?php echo form_error('no_kamar', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <label>Check In</label>
                <input type="date" name="check_in" class="form-control" value="<?php echo $pemesan['check_in'] ?>" readonly>
                <?php echo form_error('check_in', '<div class="text-danger">', '</div>') ?>
            </div>
            <input type="hidden" name="check_out" class="form-control" value="<?php echo $pemesan['check_out'] ?>">
            <div class="form-group">
                <label>Check Out</label>
                <input type="date" name="check_out_baru" class="form-control" value="<?php echo $pemesan['check_out'] ?>">
                <?php echo form_error('check_out_baru', '<div class="text-danger">', '</div>') ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Perpanjang</button>
                <a href="<?php echo base_url('operator/pemesanan/index/' . $hotel['id_hotel']) ?>" class="btn btn-danger btn-sm">Batal</a>
            </div>
        </form>
    </div>
</div>