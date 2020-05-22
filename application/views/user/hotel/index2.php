<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $judul ?></title>
    <meta name="description" content="Free Bootstrap 4 Template by uicookies.com">
    <meta name="keywords" content="Free website templates, Free bootstrap themes, Free template, Free bootstrap, Free website template">

    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/fonts/law-icons/font/flaticon.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/fonts/fontawesome/css/font-awesome.min.css">


    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/slick-theme.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/helpers.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>templates_user2/css/landing-2.css">
    <?php echo $map['js'] ?>
</head>

<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">

    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('user/home') ?>">SI Perhotelan</a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="probootstrap-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('user/home') ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-beranda">Beranda <?php echo $hotel['nama_hotel'] ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-tipe_kamar">Tipe Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-pesan_kamar">Pesan Kamar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <!-- =========================================================================================== -->

    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light" id="section-beranda">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <!-- ***************************************** -->
                    <?php if ($this->session->flashdata('sukses')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('sukses') ?>
                        </div>
                        <a href="<?php echo base_url('user/pemesanan/cetak') ?>" target="_blank" class="btn btn-success"><b><i class="fa fa-print"></i> Bukti Pemesanan</b></a>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('danger')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('danger') ?>
                        </div>
                    <?php endif ?>
                    <!-- ***************************************** -->
                    <h2 class="heading mb-2 text-center"><?php echo $hotel['nama_hotel'] ?></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sub-heading">
                                <p class="mb-2">
                                    <img src="<?php echo base_url('template/images/' . $hotel['foto']) ?>" class="card-img-top" style="height:6rem; width:10rem;">
                                    <br>
                                    Alamat : <?php echo $hotel['alamat'] ?><br>
                                    No Telepon: <?php echo $hotel['no_telepon'] ?> 
                                </p>
                                   <div class="row mt-2">
                                    <a class="btn btn-success smoothscroll mr-2" href="#section-tipe_kamar">Tipe Kamar</a>
                                    <a class="btn btn-secondary smoothscroll ml-2" href="#section-pesan_kamar">Pesan Kamar</a>
                             </div>
                    </div>
                        </div>
                        <div class="col-md-8">
                            <div class="sub-heading">
                                <p class="mb-2">
                                    <?php
                                        echo $hotel['tentang'];
                                     ?>
                                </p>
                             </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- =====================================================================================================     -->

    <section class="pb_section bg-light pb_slant-white pb_pb-250" id="section-tipe_kamar">
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 text-center mb-2">
                    <h2>Tipe Kamar</h2>
                </div>
            </div>

            <?php
            $id_hotel = $hotel['id_hotel'];
            $tipe_kamar = $this->db->get_where('tipe_kamar', ['id_hotel' => $id_hotel])->result_array();
            ?>
            <?php foreach ($tipe_kamar as $tk) : ?>
                <div class="row mb-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title"><?php echo $tk['tipe_kamar'] ?></h5>
                                        <p class="card-text">
                                            Harga : <?php echo $tk['harga_kamar'] ?> <br>
                                            Keteranga : <?php echo $tk['keterangan'] ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="<?php echo base_url('template/images/' . $tk['foto_kamar']) ?>" class="img-thumbnail">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <!-- END section -->

    <!-- ================================================================================================== -->

    <section class="pb_section pb_slant-light pb_pb-220" id="section-pesan_kamar">
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 text-center mb-2">
                    <h2>Boking Kamar</h2>
                </div>
            </div>
            <div class="row">
                    <?php

                    $id_hotel = $hotel['id_hotel'];
                    $kamar = $this->db->get_where('kamar', ['id_hotel' => $id_hotel])->result_array();
                    foreach ($kamar as $k) :
                    ?>
                        <?php if ($k['id_tipe_kamar'] == '0') : ?>
                        <?php else : ?>
                            <?php
                            $id_kamar=$k['id_kamar'];
                            $cek_pemesanan=$this->db->get_where('pemesanan',['id_kamar'=> $id_kamar])->result_array();
                            if($cek_pemesanan):
                            else : ?>
                            <div class="col-md-4 mb-5">
                                <div class="card" style="width: 20rem;">
                                    <?php $cek_tipe_kamar = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $k['id_tipe_kamar']])->row_array() ?>
                                    <img src="<?php echo base_url('template/images/' . $cek_tipe_kamar['foto_kamar']) ?>" class="card-img-top" style="height:10rem; width:20rem;">
                                    <div class="card-body">
                                        <h3 class="card-title text-center"><b><?php echo $k['no_kamar'] ?></b></h3>
                                        <p class="card-text"><?php echo 'Rp. ' . number_format($cek_tipe_kamar['harga_kamar'], 0, ',', '.') ?></p>
                                        <p class="card-text"><?php echo $cek_tipe_kamar['keterangan'] ?></p>
                                        <?php if ($k['status_kamar'] == '0') : ?>
                                            <a href="<?php echo base_url('user/pemesanan/index/' . $k['id_kamar']) ?>" class="btn btn-primary">Pesan Kamar</a>
                                        <?php else : ?>
                                            <a href="<?php echo base_url('user/pemesanan/index/' . $k['id_kamar']) ?>" class="btn btn-danger disabled">Kamar Sudah Di Pesan</a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endif
                             ?> 
                        <?php endif ?>
                    <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- ================================================================================================= -->

    <footer class="pb_footer bg-light" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col text-center mt-2">
                    <br>
                    <p class="pb_font-14">&copy; 2020 <br>WF002</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="pb_loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#1d82ff" /></svg></div>



    <script src="<?php echo base_url() ?>templates_user2/js/jquery.min.js"></script>

    <script src="<?php echo base_url() ?>templates_user2/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>templates_user2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>templates_user2/js/slick.min.js"></script>
    <script src="<?php echo base_url() ?>templates_user2/js/jquery.mb.YTPlayer.min.js"></script>

    <script src="<?php echo base_url() ?>templates_user2/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url() ?>templates_user2/js/jquery.easing.1.3.js"></script>

    <script src="<?php echo base_url() ?>templates_user2/js/main.js"></script>

</body>

</html>