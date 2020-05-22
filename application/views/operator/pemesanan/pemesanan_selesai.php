<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b><?php echo $hotel['nama_hotel'] ?></b>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Kamar</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($pemesanan_selesai as $ps) : ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $ps['nama_pemesan'] ?></td>
                            <td><?php echo $ps['no_pemesan'] ?></td>
                            <td><?php echo $ps['alamat_pemesan'] ?></td>
                            <td>
                                No Kamar : <?php echo $ps['no_kamar'] ?><br>
                                Tipe Kamar : <?php echo $ps['tipe_kamar'] ?><br>
                                Harga Kamar : <?php echo 'Rp. ' . number_format($ps['harga_kamar'], 0, ',', '.') ?>
                            </td>
                            <td><?php echo date('d-M-Y', strtotime($ps['check_in'])) ?></td>
                            <td><?php echo date('d-M-Y', strtotime($ps['check_out'])) ?></td>
                            <td><?php echo 'Rp. ' . number_format($ps['bayar'], 0, ',', '.') ?></td>
                            <td><a href="<?php echo base_url('operator/pemesanan/hapus_pemesanan_selesai/' . $ps['id_pemesanan_selesai'].'-'.$ps['id_hotel']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('yakin ingin hapus?')">Hapus</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>