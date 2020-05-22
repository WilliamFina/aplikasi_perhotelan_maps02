<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b><?php echo $hotel['nama_hotel'] ?></b>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga Kamar</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Pilih Tipe Kamar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cek_kamar as $ck) : ?>
                        <?php if ($ck['status_kamar'] == '1') : ?>
                            <tr class="text-danger">
                            <?php else : ?>
                            <tr>
                            <?php endif ?>
                            <td><?php echo $ck['no_kamar'] ?></td>
                            <?php
                            $id_tipe_kamar2 = $ck['id_tipe_kamar'];
                            $tipe_kamar = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $id_tipe_kamar2])->row_array();
                            ?>
                            <td><?php echo $tipe_kamar['tipe_kamar'] ?></td>
                            <td><?php echo "Rp. " . number_format($tipe_kamar['harga_kamar'], 0, ',', '.') ?></td>
                            <td><?php echo $tipe_kamar['keterangan'] ?></td>
                            <td>
                                <?php if ($tipe_kamar['foto_kamar']) : ?>
                                    <img src="<?php echo base_url('template/images/' . $tipe_kamar['foto_kamar']) ?>" style="position:absolute; width:25px; height:25px;" class="img-responsive">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php
                                $id_hotel = $ck['id_hotel'];
                                $cek_tipe_kamar = $this->db->get_where('tipe_kamar', ['id_hotel' => $id_hotel])->result_array();
                                foreach ($cek_tipe_kamar as $ctk) :
                                ?>
                                    <?php if ($ck['id_tipe_kamar'] == $ctk['id_tipe_kamar']) { ?>
                                        <a href="#" class="btn btn-primary btn-sm" disabled><?php echo $ctk['tipe_kamar'] ?></a>
                                    <?php } else { ?>
                                        <?php if ($ck['status_kamar'] == '1') : ?>
                                            <a href="#" class="btn btn-danger btn-sm" disabled><?php echo $ctk['tipe_kamar'] ?></a>
                                        <?php else : ?>
                                            <a href="<?php echo base_url('operator/kamar/pilih_tipe_kamar/' . $ck['id_kamar'] . '-' . $ctk['id_tipe_kamar']) ?>" class="btn btn-danger btn-sm"><?php echo $ctk['tipe_kamar'] ?></a>
                                        <?php endif ?>
                                    <?php } ?>
                                <?php endforeach ?>
                            </td>
                            </tr>
                        <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>