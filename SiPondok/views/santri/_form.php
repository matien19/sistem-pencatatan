<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Santri $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="santri-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_santri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_angkatan')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
