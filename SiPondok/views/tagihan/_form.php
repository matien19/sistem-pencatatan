<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Tagihan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tagihan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jenis')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'id_tahun_ajaran')->textInput() ?>

    <?= $form->field($model, 'jumlah_tagihan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_tagihan')->dropDownList([ 'Lunas' => 'Lunas', 'Belum Lunas' => 'Belum Lunas', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
