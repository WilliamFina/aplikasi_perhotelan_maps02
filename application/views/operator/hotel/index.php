<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs text-center">
                        <?php
                        $kamar = $this->db->get_where('kamar', ['id_hotel' => $hotel['id_hotel']])->num_rows();
                        ?>
                        <div class="huge"><?php echo $kamar ?></div>
                        <div>Total Kamar</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('operator/kamar/index/' . $hotel['id_hotel']) ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs text-center">
                        <?php
                        $this->db->where('id_hotel', $hotel['id_hotel']);
                        $this->db->where('status_kamar', '0');
                        $kamar_kosong = $this->db->get('kamar')->num_rows();
                        ?>
                        <div class="huge"><?php echo $kamar_kosong ?></div>
                        <div>Kamar Kosong</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('operator/kamar/index/' . $hotel['id_hotel']) ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs text-center">
                        <?php
                        $id_hotel = $hotel['id_hotel'];
                        $kamar = $this->db->get_where('kamar', ['id_hotel' => $id_hotel])->result_array();
                        $kamar1 = $this->db->get_where('kamar', ['id_hotel' => $id_hotel])->row_array();
                        $this->db->like('id_kamar', $kamar1['id_kamar']);
                        foreach ($kamar as $k) {
                            $this->db->or_like('id_kamar', $k['id_kamar']);
                        }
                        $pemesanan = $this->db->get('pemesanan')->num_rows();
                        ?>
                        <div class="huge"><?php echo $pemesanan ?></div>
                        <div>Pemesanan</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('operator/pemesanan/index/' . $hotel['id_hotel']) ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs text-center">
                        <?php
                        $id_hotel = $hotel['id_hotel'];
                        $this->db->where('id_hotel', $id_hotel);
                        $this->db->where('status_kamar', '1');
                        $kamar = $this->db->get('kamar')->result_array();
                        $cek_kamar = [];
                        foreach ($kamar as $k) {
                            $id_kamar = $k['id_kamar'];
                            array_push($cek_kamar, $id_kamar);
                        }
                        if ($cek_kamar) {
                            $this->db->where_in('id_kamar', $cek_kamar);
                            $this->db->where('status_pemesan', '2');
                            $pemesanan = $this->db->get('pemesanan')->num_rows();
                        } else {
                            $pemesanan = '0';
                        }
                        ?>
                        <div class="huge"><?php echo $pemesanan ?></div>
                        <div>Kamar Diisi</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo base_url('operator/kamar/index/' . $hotel['id_hotel']) ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- ------------------------------------------------------- -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b><?php echo $hotel['nama_hotel'] ?></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <?php
                    $id_hotel = $hotel['id_hotel'];
                    $cek_tipe_kamar = $this->db->get_where('tipe_kamar', ['id_hotel' => $id_hotel])->result_array();
                    foreach ($cek_tipe_kamar as $ctk) :
                    ?>
                        <li><a href="#<?php echo $ctk['id_tipe_kamar'] ?>" data-toggle="tab"><?php echo $ctk['tipe_kamar'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="text-center"><?php echo $hotel['nama_hotel'] ?></h2>
                                <br>
                                <p>
                                    Alamat : <?php echo $hotel['alamat'] ?><br>
                                    No Telepon : <?php echo $hotel['no_telepon'] ?><br>
                                    Jumlah Kamar: <?php echo $hotel['jumlah_kamar'] ?> kamar
                                </p>
                            </div>
                            <div class="col-md-6">
                                <img src="<?php echo base_url('template/images/' . $hotel['foto']) ?>" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <?php foreach ($cek_tipe_kamar as $ctk) : ?>
                        <div class="tab-pane fade" id="<?php echo $ctk['id_tipe_kamar'] ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="text-center"><?php echo $ctk['tipe_kamar'] ?></h3>
                                    <br>
                                    <p>Harga Kamar : <?php echo $ctk['harga_kamar'] ?></p>
                                    <p>Keterangan : <?php echo $ctk['keterangan'] ?></p>
                                </div>
                                <div class="col-md-6">
                                    <img src="<?php echo base_url('template/images/' . $ctk['foto_kamar']) ?>" class="img-thumbnail">
                                </div>
                            </div>



                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>