<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b><?php echo $hotel['nama_hotel'] ?></b>
    </div>
    <div class="panel-body">
        <a href="<?php echo base_url('operator/tipe_kamar/tambah/' . $hotel['id_hotel']) ?>" class="btn btn-primary btn-sm">Tambah Tipe Kamar</a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Kamar</th>
                        <th>Harga Kamar</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($tipe_kamar as $tk) : ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $tk['tipe_kamar'] ?></td>
                            <td><?php echo 'Rp. ' . number_format($tk['harga_kamar'], 0, ',', '.') ?></td>
                            <td><?php echo $tk['keterangan'] ?></td>
                            <td>
                                <img src="<?php echo base_url('template/images/' . $tk['foto_kamar']) ?>" style="position:absolute; width:25px; height:25px;">
                            </td>
                            <td>
                                <a href="<?php echo base_url('operator/tipe_kamar/edit/' . $tk['id_tipe_kamar']) ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="<?php echo base_url('operator/tipe_kamar/hapus/' . $tk['id_tipe_kamar']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>