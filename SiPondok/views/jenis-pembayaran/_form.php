<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\JenisPembayaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jenis-pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_jenis')->textInput() ?>

    <?= $form->field($model, 'nama_pembayaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'keterangan')->textarea(['rows' => 2]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
