<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Kelas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
