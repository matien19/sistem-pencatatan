<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\TagihanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tagihan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_tagihan') ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'id_jenis') ?>

    <?= $form->field($model, 'id_tahun_ajaran') ?>

    <?= $form->field($model, 'jumlah_tagihan') ?>

    <?php // echo $form->field($model, 'status_tagihan') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
