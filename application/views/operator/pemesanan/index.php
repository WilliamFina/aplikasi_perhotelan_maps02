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
                        <th>NO Telepon</th>
                        <th>Alamat</th>
                        <th>Kamar</th>
                        <!-- <th>Status</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($pemesanan as $p) :  ?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo $p['nama_pemesan'] ?></td>
                            <td><?php echo $p['no_pemesan'] ?></td>
                            <td><?php echo $p['alamat_pemesan'] ?></td>
                            <?php
                            $kamar = $this->db->get_where('kamar', ['id_kamar' => $p['id_kamar']])->row_array();
                            ?>
                            <td>
                                No : <?php echo $kamar['no_kamar'] ?><br>
                                Check In&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo date('d-m-Y', strtotime($p['check_in'])) ?><br>
                                Check Out : <?php echo date('d-m-Y', strtotime($p['check_out'])) ?>
                            </td>
                            <!-- <td>
                                <?php if ($p['status_pemesan'] == '0') : ?>
                                    belum diproses
                                <?php elseif ($p['status_pemesan'] == '1') : ?>
                                    menunggu check in
                                <?php else : ?>
                                    sudah masuk di kamar
                                <?php endif ?>
                            </td> -->
                            <td>
                                <?php if ($p['status_pemesan'] == '0') : ?>
                                    <a href="<?php echo base_url('operator/pemesanan/proses/' . $p['id_pemesan']) ?>" class="btn btn-primary btn-sm">Proses</a>
                                <?php elseif ($p['status_pemesan'] == '1') : ?>
                                    <a href="<?php echo base_url('operator/pemesanan/check_in/' . $p['id_pemesan']) ?>" class="btn btn-success btn-sm">Check In</a>
                                <?php else : ?>
                                    <a href="<?php echo base_url('operator/pemesanan/perpanjang/' . $p['id_pemesan']) ?>" class="btn btn-primary btn-sm">Perpanjang</a>
                                    <a href="<?php echo base_url('operator/pemesanan/check_out/' . $p['id_pemesan']) ?>" class="btn btn-danger btn-sm">Check Out</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>