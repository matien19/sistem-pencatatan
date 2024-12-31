<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="histori-pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pembayaran')->textInput() ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_bayar')->textInput() ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_pembayaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_pencatat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'waktu_dibuat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
