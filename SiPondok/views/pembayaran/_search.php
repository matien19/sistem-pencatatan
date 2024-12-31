<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\PembayaranSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pembayaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_pembayaran') ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'id_jenis') ?>

    <?= $form->field($model, 'id_tahun_ajaran') ?>

    <?= $form->field($model, 'tanggal_bayar') ?>

    <?php // echo $form->field($model, 'jumlah_bayar') ?>

    <?php // echo $form->field($model, 'metode_pembayaran') ?>

    <?php // echo $form->field($model, 'bukti_pembayaran') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
