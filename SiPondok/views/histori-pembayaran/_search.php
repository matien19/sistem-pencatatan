<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaranSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="histori-pembayaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_histori') ?>

    <?= $form->field($model, 'id_pembayaran') ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'tanggal_bayar') ?>

    <?= $form->field($model, 'jumlah_bayar') ?>

    <?php // echo $form->field($model, 'jenis_pembayaran') ?>

    <?php // echo $form->field($model, 'admin_pencatat') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'waktu_dibuat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
