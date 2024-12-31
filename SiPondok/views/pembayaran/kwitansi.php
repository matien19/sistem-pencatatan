<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */

$this->title = 'Kwitansi Pembayaran';
$this->registerCssFile('@web/css/kwitansi.css');
?>
<div class="kwitansi" style="border: 1px solid #000; padding: 20px; width: 60%; margin: auto; position: relative; font-family: Arial, sans-serif; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">
    <!-- Header Kwitansi -->
    <h2 style="text-align: center; margin-top: 0;">KWITANSI PEMBAYARAN</h2>

    <!-- Logo Pondok Pesantren -->
    <img src="<?= Yii::getAlias('@web/img/pp-ponpes.jpeg') ?>" alt="Logo Pondok Pesantren" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.1; width: 500px; z-index: 0;">

    <!-- Tabel Data Kwitansi -->
    <table style="width: 100%; text-align: left; z-index: 1; border-collapse: collapse;">
        <tr>
            <td style="width: 35%; font-weight: bold; padding-right: 5px;">No. Kwitansi</td>
            <td style="width: 5%; text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->id_pembayaran ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">NIS Santri</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->santri->nis ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Nama Santri</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->santri->nama_santri ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Jenis Pembayaran</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->jenisPembayaran ? $model->jenisPembayaran->nama_pembayaran : '-' ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Bulan</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->bulan ?: '-' ?></td>
        </tr>
        <!-- <tr>
            <td style="font-weight: bold; padding-right: 5px;">Tahun Ajaran</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->tahunAjaran ? $model->tahunAjaran->tahun : '-' ?></td>
        </tr> -->
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Tanggal Bayar</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= Yii::$app->formatter->asDate($model->tanggal_bayar, 'long') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Jumlah Bayar</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= Yii::$app->formatter->asCurrency($model->jumlah_bayar) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-right: 5px;">Metode Pembayaran</td>
            <td style="text-align: left;">:</td>
            <td style="border-bottom: 1px solid #000; padding-left: 5px;"><?= $model->metode_pembayaran ?: '-' ?></td>
        </tr>
    </table>

    <!-- Footer Tanda Tangan -->
    <div style="margin-top: 50px; display: flex; justify-content: space-between;">
        <div class="signature" style="width: 30%; text-align: center;">
            <p>Tanda Tangan Penerima</p>
            <div style="border-top: 1px solid #000; margin-top: 60px;">
                <!-- <p>Nama Penerima</p> -->
            </div>
        </div>
        <div class="signature" style="width: 30%; text-align: center;">
            <p>Tanda Tangan Admin</p>
            <div style="border-top: 1px solid #000; margin-top: 60px;">
                <!-- <p>Admin</p> -->
            </div>
        </div>
    </div>
</div>

<!-- <div style="text-align: right; margin-top: 30px;">
    <?= Html::a('Cetak Kwitansi', null, [
        'class' => 'btn btn-success',
        'onclick' => 'window.print(); return false;',  // Menampilkan dialog print
    ]) ?>
</div> -->
