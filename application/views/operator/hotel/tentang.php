<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b><?php echo $hotel['nama_hotel'] ?></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo base_url('operator/home/tentang_aksi/' . $hotel['id_hotel']) ?>" method="post">
                    <div class="form-group">
                        <textarea name="tentang" class="form-control" rows="8" required ><?php echo $hotel['tentang']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>