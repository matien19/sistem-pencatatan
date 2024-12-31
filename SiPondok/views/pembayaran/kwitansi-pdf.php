<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pembayaran $model */

?>
<div style="border: 1px solid #ccc; padding: 15px; width: 100%; font-family: Arial, sans-serif; font-size: 14px;">
    <h2 style="text-align: center; font-size: 18px; margin-bottom: 20px;">KWITANSI PEMBAYARAN</h2>

    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="width: 40%; font-weight: bold;">No. Kwitansi</td>
            <td style="width: 5%; text-align: center;">:</td>
            <td><?= Html::encode($model->id_pembayaran) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NIS Santri</td>
            <td style="text-align: center;">:</td>
            <td><?= Html::encode($model->santri->nis) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Santri</td>
            <td style="text-align: center;">:</td>
            <td><?= Html::encode($model->santri->nama_santri) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jenis Pembayaran</td>
            <td style="text-align: center;">:</td>
            <td><?= Html::encode($model->jenisPembayaran ? $model->jenisPembayaran->nama_pembayaran : '-') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Tanggal Bayar</td>
            <td style="text-align: center;">:</td>
            <td><?= Yii::$app->formatter->asDate($model->tanggal_bayar, 'long') ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Jumlah Bayar</td>
            <td style="text-align: center;">:</td>
            <td><?= Yii::$app->formatter->asCurrency($model->jumlah_bayar) ?></td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Metode Pembayaran</td>
            <td style="text-align: center;">:</td>
            <td><?= Html::encode($model->metode_pembayaran ?: '-') ?></td>
        </tr>
    </table>

    <div style="margin-top: 30px; text-align: right;">
        <p style="font-weight: bold;">Tanda Tangan Admin</p>
        <div style="border-top: 1px solid #000; width: 200px; margin: 10px auto;"></div>
    </div>
</div>