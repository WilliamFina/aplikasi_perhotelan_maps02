<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('user/home') ?>"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $hotel['nama_hotel'] ?></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md">
                <div class="card mb-2">
                    <img class="card-img-top" src="<?php echo base_url('template/images/' . $hotel['foto']) ?>" alt="Card image cap" style="height:300px;">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $hotel['nama_hotel'] ?></h1>
                        <p class="card-text">
                            Alamat : <?php echo $hotel['alamat'] ?><br>
                            No Telepon : <?php echo $hotel['no_telepon'] ?><br>
                        </p>
                        <a href="<?php echo base_url('user/home') ?>" class="btn btn-dark btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
        </div>