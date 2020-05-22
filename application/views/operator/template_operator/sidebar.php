<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url('operator/home/index/' . $hotel['id_hotel']) ?>"><i class="fa fa-home"></i> Beranda Operator</a>
            </li>
            <li>
                <a href="#"> Kamar<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url('operator/kamar/index/' . $hotel['id_hotel']) ?>">List Kamar</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('operator/tipe_kamar/index/' . $hotel['id_hotel']) ?>">Tipe Kamar</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"> Pemesanan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url('operator/pemesanan/index/' . $hotel['id_hotel']) ?>">Pemesanan Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('operator/pemesanan/pemesanan_selesai/' . $hotel['id_hotel']) ?>">Pemesanan Selesai</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo base_url('operator/home/ganti_password/' . $hotel['id_hotel']) ?>">Ganti Password</a>
            </li>
              <li>
                <a href="<?php echo base_url('operator/home/tentang/' . $hotel['id_hotel']) ?>">Tentang Hotel</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <div class="row">
                        <h1>&nbsp;<?php echo $judul ?></h1>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php if ($this->session->flashdata('sukses')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('sukses') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('danger')) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('danger') ?>
            </div>
        <?php endif ?>