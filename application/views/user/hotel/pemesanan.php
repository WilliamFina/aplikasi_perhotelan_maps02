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
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('user/hotel/index/' . $hotel['id_hotel']) ?>">Beranda <?php echo $hotel['nama_hotel'] ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-kamar">Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-pesan_kamar">Pesan Kamar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <!-- =========================================================================================== -->

    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light" id="section-kamar">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <!-- ***************************************** -->
                    <?php if ($this->session->flashdata('danger')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('danger') ?>
                        </div>
                    <?php endif ?>
                    <!-- ***************************************** -->
                    <h2 class="heading mb-3 text-center"><?php echo $hotel['nama_hotel'] ?></h2>
                    <div class="sub-heading">
                        <?php $cek_tipe_kamar = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $kamar['id_tipe_kamar']])->row_array() ?>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <img src="<?php echo base_url('template/images/' . $cek_tipe_kamar['foto_kamar']) ?>" class="img-thumbnail" style="height:10rem; width:20rem;"><br>
                            </div>
                            <div class="col-md-8">
                                <h4 class="mb-2">
                                    Kamar No : <?php echo $kamar['no_kamar'] ?><br>
                                    Tipe kamar : <?php echo $cek_tipe_kamar['tipe_kamar'] ?><br>
                                    Harga kamar : <?php echo 'Rp. ' . number_format($cek_tipe_kamar['harga_kamar'], 0, ',', '.') ?><br>
                                    Keterangan : <?php echo $cek_tipe_kamar['keterangan'] ?>
                                </h4>
                            </div>
                        </div>
                        <p class="mb-5 text-center">
                            <a class="btn btn-success btn-lg pb_btn-pill smoothscroll" href="#section-pesan_kamar"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">Pesan Kamar</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- =====================================================================================================     -->

    <section class="pb_section bg-light pb_slant-white pb_pb-250" id="section-pesan_kamar">
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 text-center mb-2">
                    <h2>Form Pesan Kamar</h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="<?php echo base_url('user/pemesanan/pemesanan/' . $kamar['id_kamar']) ?>" class="bg-white rounded pb_form_v1" method="post">
                        <input type="hidden" name="id_kamar" value="<?php echo $kamar['id_kamar'] ?>">
                        <div class="form-group">
                            <label>Check In</label>
                            <input type="date" name="check_in" class="form-control pb_height-50 reverse">
                            <?php echo form_error('check_in', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Check Out</label>
                            <input type="date" name="check_out" class="form-control pb_height-50 reverse">
                            <?php echo form_error('check_out', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_pemesan" class="form-control pb_height-50 reverse" value="<?php echo set_value('nama_pemesan') ?>">
                            <?php echo form_error('nama_pemesan', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_pemesan" class="form-control pb_height-50 reverse" value="<?php echo set_value('no_pemesan') ?>">
                            <?php echo form_error('no_pemesan', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat_pemesan" class="form-control reverse" rows="3"><?php echo set_value('alamat_pemesan') ?></textarea>
                            <?php echo form_error('alamat_pemesan', '<div class="text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block pb_btn-pill  btn-shadow-blue">Pesan</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
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