<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\TahunAjaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tahun-ajaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tahun_ajaran')->textInput() ?>

    <?= $form->field($model, 'tahun_ajaran')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
