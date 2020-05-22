<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CETAK</title>
   <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('template') ?>/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <h1 style="line-height:1;"><?php echo $hotel['nama_hotel'] ?></h1>
                <span style="line-height:1;">
                    Alamat: <?php echo $hotel['alamat'] ?><br>
                    Kontak: <?php echo $hotel['no_telepon'] ?>
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <p align="center"><u>Bukti Pemesanan</u><br>
    </p>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>Nama pemesan</th>
                <th>No Telepon</th>
                <th>No Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $pemesanan['nama_pemesan'] ?></td>
                <td><?php echo $pemesanan['no_pemesan'] ?></td>
                <td><?php echo $kamar['no_kamar'] ?></td>
                <td><?php echo date('d-M-Y', strtotime($pemesanan['check_in'])) ?></td>
                <td><?php echo date('d-M-Y', strtotime($pemesanan['check_out'])) ?></td>
            </tr>
        </tbody>
    </table>
      </div>
</body>

</html>