<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\Tagihan $model */

$this->title = $model->id_tagihan;
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tagihan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_tagihan' => $model->id_tagihan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_tagihan' => $model->id_tagihan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <!-- Kolom pertama -->
        <div class="col-lg-6">
            <table class="table table-striped table-sm">
                <tr>
                    <th>NIS dan Nama Santri</th>
                    <td>
                        <?= $model->santri ? $model->santri->nis .' - '. $model->santri->nama_santri : 'Tidak ada'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Tagihan</th>
                    <td>
                        <?= $model->jenisPembayaran ? $model->jenisPembayaran->nama_pembayaran : 'Tidak ada'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tahun Ajaran</th>
                    <td>
                        <?= $model->tahunAjaran ? $model->tahunAjaran->tahun_ajaran : 'Tidak ada'; ?>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Kolom kedua -->
        <div class="col-lg-6">
            <table class="table table-striped table-sm">
                <tr>
                    <th>Jumlah Tagihan</th>
                    <td><?= $model->jumlah_tagihan; ?></td>
                </tr>
                <tr>
                    <th>Status Tagihan</th>
                    <td><?= $model->status_tagihan; ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td><?= nl2br(Html::encode($model->keterangan)); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <?php 
        if ($model->status_tagihan === 'Belum Lunas') { ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="pembayaran-form">
                        <h4>Belum Ada Pembayaran</h4>
                        <div class="row">
                            <?= Html::a('Lunaskan Tunai', ['tagihan/lunas', 'id_tagihan' => $model->id_tagihan], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Apakah ingin melunaskan tagihan ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>        
    <?php
    } else { ?>
        <div class="card">
            <div class="card-body">
              
                <div class="row">
                    <!-- Kolom pertama -->
                    <div class="col-lg-12">
                        <?php
                            if ($pembayaranTagihanModel) { ?>
                            <table class="table table-striped table-sm">
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <td> : </td>
                                    <td>
                                        <?= $pembayaranTagihanModel->jumlah_bayar ? $pembayaranTagihanModel->jumlah_bayar : 'Tidak ada'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td> : </td>
                                    <td>
                                        <?= $pembayaranTagihanModel->tanggal_bayar ? date('d F Y H:i', strtotime($pembayaranTagihanModel->tanggal_bayar)) . ' WIB' : 'Tidak ada'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td> : </td>
                                    <td>
                                        <?= $pembayaranTagihanModel->keterangan ? $pembayaranTagihanModel->keterangan : 'Tidak ada'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td> : </td>
                                    <td>
                                        <?= $pembayaranTagihanModel->status ? $pembayaranTagihanModel->status  == 'Validasi' ? '<span class="badge bg-warning">' . $pembayaranTagihanModel->status .'</span> (meenunggu validasi admin)'. '' 
                                        : '<span class="badge bg-success">' .$pembayaranTagihanModel->status . '</span>' : 'Tidak ada'; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bukti Pembayaran</th>
                                    <td> : </td>
                                    <td>
                                    <?= $pembayaranTagihanModel->bukti_pembayaran 
                                        ? '<img src="' . $pembayaranTagihanModel->bukti_pembayaran . '" alt="Bukti Pembayaran" class="img-fluid" style="width: 200px;" />' 
                                        : 'Tidak ada'; ?>                                    
                                       
                                    </td>
                                </tr>
                                <?php 
                                    if ($pembayaranTagihanModel->status == 'Validasi') { ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                            <div class="row">
                                                <div class="col-lg-">
                                                <?= Html::a('Terima', ['tagihan/terima', 'id_pembayaran' => $pembayaranTagihanModel->id_pembayaran], [
                                                    'class' => 'btn btn-success',
                                                    'data' => [
                                                        'confirm' => 'Apakah ingin menerima pemabayran ini?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>                           
                                                <?= Html::a('Tolak', ['tagihan/tolak', 'id_pembayaran' => $pembayaranTagihanModel->id_pembayaran], [
                                                    'class' => 'btn btn-danger',
                                                    'data' => [
                                                        'confirm' => 'Apakah ingin menolak pemabayran ini?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                <?php 
                                }
                                ?>
                            </table>
                        <?php
                            } else {
                                echo '<h4>Data Pembayaran Telah Terhapus</h4>';
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
     }
    ?>

</div>
