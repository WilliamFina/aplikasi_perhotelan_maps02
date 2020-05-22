<div class="panel panel-default">
    <div class="panel-heading">
        Data Hotel
    </div>
    <div class="panel-body">
        <a href="<?php echo base_url('admin/hotel/tambah') ?>" class="btn btn-primary btn-sm">Tambah</a>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hotel</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Jumlah Kamar</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($hotel as $h) : ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $h['nama_hotel'] ?></td>
                            <td><?php echo $h['alamat'] ?></td>
                            <td><?php echo $h['no_telepon'] ?></td>
                            <td><?php echo $h['jumlah_kamar'] ?></td>
                            <td>
                                <img src="<?php echo base_url('template/images/' . $h['foto']) ?>" style="position:absolute; width:25px; height:25px;">
                            </td>
                            <td>
                                <a href="<?php echo base_url('admin/hotel/ubah/' . $h['id_hotel']) ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="<?php echo base_url('admin/hotel/hapus/' . $h['id_hotel']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus? ')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</div>