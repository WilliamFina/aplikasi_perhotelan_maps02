<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url('admin/home') ?>"><i class="fa fa-home"></i> Beranda Admin</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/hotel') ?>"> Hotel</a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/wisata') ?>"> Wisata</a>
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