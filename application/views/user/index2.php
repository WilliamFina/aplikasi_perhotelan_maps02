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
                    <li class="nav-item"><a class="nav-link" href="#section-home"><i class="fa fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-hotel">Hotel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-map">Map</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <!-- =========================================================================================== -->

    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light" id="section-home">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <!-- ***************************************** -->
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
                    <!-- ***************************************** -->
                    <h2 class="heading mb-3">Sistem Informasi Perhotelan</h2>
                    <div class="sub-heading">
                        <p class="mb-4">Aplikasi ini dibuat untuk sistem informasi perhotelan</p>
                        <p class="mb-5">
                            <a class="btn btn-success btn-lg pb_btn-pill smoothscroll" href="#section-hotel"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">Hotel</span></a>
                            <a class="btn btn-secondary btn-lg pb_btn-pill smoothscroll" href="#section-map"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">Map</span></a>
                            <a class="btn btn-dark btn-lg pb_btn-pill smoothscroll" href="#section-login"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">Login</span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- =====================================================================================================     -->

    <section class="pb_section bg-light pb_slant-white pb_pb-250" id="section-hotel">
        <div class="container">
            <div class="row justify-content-center mb-1">
            
                <!-- <div class="row"> -->
                <div class="card-deck">
                    <?php foreach ($hotel as $h) : ?>
                        <div class="col-md-4 mb-5">
                            <div class="card" style="width: 20rem;">
                                <img src="<?php echo base_url('template/images/' . $h['foto']) ?>" class="card-img-top" style="height:10rem; width:20rem;">
                                <div class="card-body">
                                    <h4 class="card-title text-center"><a href="<?php echo base_url('user/hotel/index/' . $h['id_hotel']) ?>"><?php echo $h['nama_hotel'] ?></a></h4>
                                    <p class="card-text">
                                        Alamat : <?php echo $h['alamat'] ?> <br>
                                        No telepon : <?php echo $h['no_telepon'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- </div>zz -->
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- ================================================================================================== -->

    <section class="pb_section pb_slant-light pb_pb-220" id="section-map">
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 text-center mb-2">
                    <h2>Map</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 class="mt-2 mb-2 text-center">Map Penyebaran Hotel dan Wisata Di Kota Kupang</h4>
                    <form action="<?php echo base_url('user/home/map_cari') ?>" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat1" class="form-control">
                                        <?php foreach ($hotel as $h) : ?>
                                            <option value="<?php echo $h['id_hotel'] ?>"><?php echo $h['nama_hotel'] ?></option>
                                        <?php endforeach ?>
                                        <!-- <?php foreach ($wisata as $w) : ?>
                                            <option value="<?php echo $w['id_wisata'] ?>"><?php echo $w['nama_wisata'] ?></option>
                                        <?php endforeach ?> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat2" class="form-control">
                                        <!-- <?php foreach ($hotel as $h) : ?>
                                            <option value="<?php echo $h['id_hotel'] ?>"><?php echo $h['nama_hotel'] ?></option>
                                        <?php endforeach ?> -->
                                        <?php foreach ($wisata as $w) : ?>
                                            <option value="<?php echo $w['id_wisata'] ?>"><?php echo $w['nama_wisata'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="Telusuri" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <?php echo $map['html']; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <!-- ======================================================================================================= -->

    <section class="pb_section pb_slant-white" id="section-login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-2">
                    <h2>Login</h2>
                </div>
            </div>
            <div class="row">
                <!-- ================================= -->
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <form action="<?php echo base_url('login/check') ?>" class="bg-white rounded pb_form_v1" method="post">
                        <h2 class="mb-4 mt-0 text-center"></h2>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control pb_height-50 reverse" placeholder="username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control pb_height-50 reverse" placeholder="password">
                        </div>
                        <div class="form-group">
                            <div class="pb_select-wrap">
                                <select class="form-control pb_height-50 reverse" name="hak_akses">
                                    <option value="admin" selected>Admin</option>
                                    <?php
                                    $hotel = $this->db->get('hotel')->result_array();
                                    foreach ($hotel as $h) :
                                    ?>
                                        <option value="<?php echo $h['id_hotel'] ?>"><?php echo $h['nama_hotel'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block pb_btn-pill  btn-shadow-blue">Login</button>
                        </div>
                    </form>

                </div>
                <!-- ============================== -->
            </div>
        </div>
    </section>

    <!-- ================================================================================================= -->

    <footer class="pb_footer bg-light" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col text-center">
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