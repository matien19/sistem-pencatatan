<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pembayaran-form">

    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php 
        $dataPost = ArrayHelper::map(\SiPondok\models\Tagihan::find()->all(), 'id_tagihan', 'nis'); 
        echo $form->field($model, 'id_tagihan')->dropDownList($dataPost, ['prompt' => 'Pilih Tagihan']);
    ?>

    <?php 
        $dataPost = ArrayHelper::map(\SiPondok\models\TahunAjaran::find()->all(), 'id_tahun_ajaran', 'tahun_ajaran'); 
        echo $form->field($model, 'id_tahun_ajaran')->dropDownList($dataPost, ['prompt' => 'Pilih Tahun Ajaran']);
    ?>

    <?= $form->field($model, 'tanggal_bayar')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metode_pembayaran')->dropDownList(
        ['transfer' => 'Transfer', 'tunai' => 'Tunai'],
        ['prompt' => 'Pilih Metode Pembayaran', 'id' => 'metode-pembayaran']
    ) ?>

    <div id="bukti-pembayaran-field" style="display: none;">
    <?= $form->field($model, 'bukti_pembayaran')->fileInput()?>
    </div>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Validasi' => 'Validasi', 'Lunas' => 'Lunas', ], ['prompt' => 'Pilih status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs(<<<JS
$(document).ready(function () {
    // Fungsi untuk mengatur tampilan kolom bulan
    function toggleBulanField() {
        var selectedValue = $('#jenis-pembayaran').find(':selected').text();
        if (selectedValue === 'Spp syariah') {
            $('#bulan-container').show();
        } else {
            $('#bulan-container').hide();
            $('#bulan-input').val(''); // Kosongkan input bulan jika tidak relevan
        }
    }

    // Fungsi untuk mengatur tampilan kolom bukti pembayaran
    function toggleBuktiPembayaranField() {
        var metode = $('#metode-pembayaran').val();
        if (metode === 'transfer') {
            $('#bukti-pembayaran-field').show();
        } else {
            $('#bukti-pembayaran-field').hide();
        }
    }

    // Event listener untuk jenis pembayaran
    $('#jenis-pembayaran').on('change', function () {
        toggleBulanField();
    });

    // Event listener untuk metode pembayaran
    $('#metode-pembayaran').on('change', function () {
        toggleBuktiPembayaranField();
    });

    // Logika awal saat halaman pertama kali dimuat
    toggleBulanField(); // Cek apakah kolom bulan perlu ditampilkan
    toggleBuktiPembayaranField(); // Cek apakah kolom bukti pembayaran perlu ditampilkan
});
JS);
?>