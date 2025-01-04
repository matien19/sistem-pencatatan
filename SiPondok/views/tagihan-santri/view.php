<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Tagihan $model */

$this->title = $model->id_tagihan;
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tagihan-view">

<h1><?= Html::encode($this->title) ?></h1>

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
            <div class="card">
                <div class="card-body">
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
                    <div class="pembayaran-form">
                        <div class="form-group">
                                
                            <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                            <?= $form->field($pembayaranModel, 'id_tagihan')->hiddenInput([
                                'value' => $model->id_tagihan,
                            ])->label(false) ?>

                            <?= $form->field($pembayaranModel, 'id_tahun_ajaran')->hiddenInput([
                                'value' => $model->id_tahun_ajaran,
                            ])->label(false) ?>

                            <?= $form->field($pembayaranModel, 'jumlah_bayar')->textInput([
                                'maxlength' => true,
                                'value' => $model->jumlah_tagihan, 
                                'readonly' => true, 
                                'required' => true,
                                ]) ?>

                            <?= $form->field($pembayaranModel, 'keterangan')->textarea([
                                'rows' => 2,
                                'required' => true,
                                ]) ?>

                                
                            <?= $form->field($pembayaranModel, 'bukti_pembayaran')->fileInput([
                                'class' => 'form-control',
                                'accept' => 'image/jpeg, image/png',
                                'required' => true,
                                ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Bayar', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>        
        <?php
        } else { ?>
            <div class="card">
                <div class="card-body">
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
                                            <?= $pembayaranTagihanModel->tanggal_bayar ?date('d F Y H:i', strtotime($pembayaranTagihanModel->tanggal_bayar)) . ' WIB' : 'Tidak ada'; ?>
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

<script>
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('.alert');
        flashMessages.forEach(function(message) {
            message.style.transition = 'opacity 0.5s';
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 500);
        });
    }, 2000);
</script>
