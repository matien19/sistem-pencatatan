<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Tagihan $model */
/** @var yii\widgets\ActiveForm $form */

$nominalData = \SiPondok\models\JenisPembayaran::find()->select(['id_jenis', 'nominal'])->asArray()->all(); 
$nominalJson = json_encode(ArrayHelper::map($nominalData, 'id_jenis', 'nominal')); 
?>

<div class="tagihan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        $dataPost = ArrayHelper::map(\SiPondok\models\Santri::find()->all(), 'nis', 'nama_santri'); 
        echo $form->field($model, 'nis')->dropDownList($dataPost, ['prompt' => 'Pilih Nama Santri']);
    ?>
    
    <?php 
        $dataPost = ArrayHelper::map(\SiPondok\models\JenisPembayaran::find()->all(), 'id_jenis', 'nama_pembayaran'); 
        echo $form->field($model, 'id_jenis')->dropDownList($dataPost, ['prompt' => 'Pilih Jenis Pembayaran']);
    ?>

    <?= $form->field($model, 'jumlah_tagihan')->textInput(['maxlength' => true, 'id' => 'jumlah_tagihan']) ?>
    
    <?php 
        $dataPost = ArrayHelper::map(\SiPondok\models\TahunAjaran::find()->all(), 'id_tahun_ajaran', 'tahun_ajaran'); 
        echo $form->field($model, 'id_tahun_ajaran')->dropDownList($dataPost, ['prompt' => 'Pilih Tahun Ajaran']);
    ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    // Data nominal dalam format JSON
    const nominalData = <?= $nominalJson ?>;

    // Event listener untuk dropdown
    document.getElementById('<?= Html::getInputId($model, 'id_jenis') ?>').addEventListener('change', function () {
        const selectedValue = this.value;
        const jumlahTagihanInput = document.getElementById('jumlah_tagihan');

        // Jika ada nominal sesuai jenis pembayaran, isi ke input jumlah tagihan
        if (nominalData[selectedValue]) {
            jumlahTagihanInput.value = nominalData[selectedValue];
        } else {
            jumlahTagihanInput.value = ''; // Kosongkan jika tidak ada
        }
    });
</script>
