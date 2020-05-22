<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-white">Sistem Informasi Perhotelan di Kota Kupang</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md mb-3">
                <div class="card">
                    <!-- <div class="card-header bg-light">
            </div> -->
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">Hotel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="false">Map</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                            <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mt-2 mb-2 text-center">Daftar Hotel Di Kota Kupang</h4>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Hotel</th>
                                                    <th>Alamat</th>
                                                    <th>No Telepon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0;
                                                foreach ($hotel as $h) : ?>
                                                    <tr>
                                                        <td><?php echo ++$i ?></td>
                                                        <td><a href="<?php echo base_url('user/hotel/index/' . $h['id_hotel']) ?>"><?php echo $h['nama_hotel'] ?></a></td>
                                                        <td><?php echo $h['alamat'] ?></td>
                                                        <td><?php echo $h['no_telepon'] ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mt-2 mb-2 text-center">Map Penyebaran Hotel Di Kota Kupang</h4>
                                        <?php echo $map['html']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>