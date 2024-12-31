<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\SantriSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="santri-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'nama_santri') ?>

    <?= $form->field($model, 'jenis_kelamin') ?>

    <?= $form->field($model, 'tanggal_lahir') ?>

    <?= $form->field($model, 'id_kelas') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'tahun_angkatan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
