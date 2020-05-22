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

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('user/home') ?>">SI Perhotelan</a>
            <!-- <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button> -->
            <!-- <div class="collapse navbar-collapse" id="probootstrap-navbar">

            </div> -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('user/home') ?>"><i class="fa fa-home"></i> Home</a></li>
            </ul>
        </div>
    </nav>
    <!-- END nav -->
    <div class="container">
        <div class="row justify-content-center mb-1">
            <div class="col-md-6 text-center mb-2">
                <h2>Map</h2>
            </div>
        </div>
        <?php if ($submit == '') : ?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat1" class="form-control">
                                        <?php foreach ($hotel as $h) : ?>
                                            <option value="<?php echo $h['id_hotel'] ?>"><?php echo $h['nama_hotel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat2" class="form-control">
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
        <?php else : ?>
            <div class="row">
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat1" class="form-control">
                                        <?php if ($tempat1) : ?>
                                            <option value="<?php echo $tempat1['id_hotel'] ?>">A. <?php echo $tempat1['nama_hotel'] ?></option>
                                        <?php endif ?>
                                        <?php foreach ($hotel as $h) : ?>
                                            <option value="<?php echo $h['id_hotel'] ?>"><?php echo $h['nama_hotel'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tempat2" class="form-control">
                                        <?php if ($tempat2) : ?>
                                            <option value="<?php echo $tempat2['id_wisata'] ?>">B. <?php echo $tempat2['nama_wisata'] ?></option>
                                        <?php endif ?>
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
                    <?php if ($tempat1 and $tempat2) : ?>
                        <?php if ($tempat1 != $tempat2) : ?>
                            <a href="https://www.google.com/maps/dir/<?php echo $tempat1['latitude'] . ',' . $tempat1['longitude']; ?>/<?php echo $tempat2['latitude'] . ',' . $tempat2['longitude']; ?>/@-10.1749491,123.6059629z/data=!4m2!4m1!3e0" class="btn btn-primary btn-block" target="_blank">Buka di Google Maps</a>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                <div class="col-md-4">
                    <div id="directionsDiv"></div>
                </div>
            </div>
        <?php endif ?>


    </div>
    <!-- ================================================================================================== -->


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