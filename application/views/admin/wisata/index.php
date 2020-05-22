<div class="panel panel-default">
    <div class="panel-heading">
        Data Wisata
    </div>
    <div class="panel-body">
        <a href="<?php echo base_url('admin/wisata/tambah') ?>" class="btn btn-primary btn-sm">Tambah</a>
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Wisata</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($wisata as $w) : ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $w['nama_wisata'] ?></td>
                            <td><?php echo $w['latitude'] ?></td>
                            <td><?php echo $w['longitude'] ?></td>
                            <td><?php echo $w['alamat'] ?></td>
                            <td>
                                <img src="<?php echo base_url('template/images/' . $w['foto']) ?>" style="position:absolute; width:25px; height:25px;">
                            </td>
                            <td>
                                <a href="<?php echo base_url('admin/wisata/ubah/' . $w['id_wisata']) ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="<?php echo base_url('admin/wisata/hapus/' . $w['id_wisata']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus? ')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</div>