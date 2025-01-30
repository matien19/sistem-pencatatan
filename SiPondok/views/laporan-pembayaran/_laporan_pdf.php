<?php

use SiPondok\models\Pembayaran;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f8f9fa;
    }
    .text-center {
        text-align: center;
    }
    .font-weight-bold {
        font-weight: bold;
    }
    /* Styling untuk tanda tangan */
    .signature-container {
        display: flex;
        justify-content: flex-end;
    }

    .signature-content {
        text-align: right;
    }

    .signature-authority {
        font-weight: bold;
    }

    .signature-line {
        text-align: right;
    }

    .signature-underline {
        border-bottom: 1px solid black;
        display: inline-block;
    }

    .signature-name {
        text-align: center;
    }

</style>
<div class="container">
    <!-- Kop Surat -->
    <div class="row">
        <div class="col-lg-2">
            <img src="<?= Yii::getAlias('@web') ?>/img/pp-ponpes.jpeg" alt="Logo" class="img-fluid" style="max-height: 100px;">
        </div>
        <div class="col-lg-10 text-center">
            <h2 class="mb-0">Pondok Pesantren Ribath Al-Musyarraf</h2>
            <p class="mb-0">Alamat: Jl. Raya Pesantren No. 123, Kota ABC</p>
            <p class="">Email: admin@pesantrenxyz.com | Telp: 0123-456789</p>
        </div>
    </div>
    <hr style="border-top: 2px solid #000;">

    <!-- Judul Halaman -->
    <h4 class="text-center mb-4">Laporan Tagihan</h4>

    <h6>Tahun Akademik : <?= Html::encode($tahunAjaran) ?></h6>
    <?= $bulan == '-' ? '<h6>1 tahun akademik</h6>' :  '<h6>Bulan          : ' . $bulan .'</h6>'  ?>
    <!-- Tabel Pembayaran -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Santri</th>
                <!-- <th>Tanggal Bayar</th> -->
                <th>Jumlah Tagihan</th>
                <!-- <th>Metode Pembayaran</th> -->
                <th>Keterangan</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pembayaran as $index => $model): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <?= Html::encode($model->santri->nis) ?><br>
                        <?= Html::encode($model->santri->nama_santri) ?>
                    </td>
                    <!-- <td>
                        < Yii::$app->formatter->asDatetime($model->tanggal_bayar, 'php:d F Y H:i') ?>
                    </td> -->
                    <td><?= Yii::$app->formatter->asCurrency($model->jumlah_tagihan) ?></td>
                    <!-- <td><Html::encode($model->metode_pembayaran) ?></td> -->
                    <td><?= Html::encode($model->keterangan) ?></td>
                    <td><?= Html::encode($model->tahunAjaran->tahun_ajaran) ?></td>
                    <td><?= Html::encode(ucfirst($model->status_tagihan)) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="text-align: right; font-weight: bold;">Total Tagihan:</td>
                <td style="font-weight: bold;"><?= Yii::$app->formatter->asCurrency($totalPembayaran) ?></td>
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>
    <div class="signature-container">
        <div class="signature-content">
            <p class="signature-date">Bumiayu, <?= Yii::$app->formatter->asDatetime('now', 'php:d F Y ') ?></p>
            <p class="signature-label">Mengetahui,</p>
            <br>
            <p class="signature-authority">Pimpinan Pondok Pesantren</p>
            <p class="signature-name"></p>
        </div>
    </div>

    
</div>
