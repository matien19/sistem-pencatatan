<?php

use SiPondok\models\JenisPembayaran;
use SiPondok\models\Santri;
use SiPondok\models\TahunAjaran;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pembayaran-form">

    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'id_pembayaran')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'nis')->dropDownList(
        ArrayHelper::map(Santri::find()->all(), 'nis', function ($model) {
            return $model->nis . ' - ' . $model->nama_santri;
        }),
        ['prompt' => 'Pilih Santri']
    ) ?>

    <?= $form->field($model, 'id_jenis')->dropDownList(
        ArrayHelper::map(JenisPembayaran::find()->all(), 'id_jenis', 'nama_pembayaran'),
        ['prompt' => 'Pilih Jenis Pembayaran', 'id' => 'jenis-pembayaran']
    ) ?>

    <div id="bulan-container" style="display: none;">
        <?= $form->field($model, 'bulan')->dropDownList(
            [
                'Januari' => 'Januari',
                'Februari' => 'Februari',
                'Maret' => 'Maret',
                'April' => 'April',
                'Mei' => 'Mei',
                'Juni' => 'Juni',
                'Juli' => 'Juli',
                'Agustus' => 'Agustus',
                'September' => 'September',
                'Oktober' => 'Oktober',
                'November' => 'November',
                'Desember' => 'Desember',
            ],
            ['prompt' => 'Pilih Bulan', 'id' => 'bulan-input']
        ) ?>
    </div>

    <?= $form->field($model, 'id_tahun_ajaran')->dropDownList(
        ArrayHelper::map(TahunAjaran::find()->all(), 'id_tahun_ajaran', 'tahun_ajaran'),
        ['prompt' => 'Pilih Tahun Ajaran']
    ) ?>

    <?= $form->field($model, 'tanggal_bayar')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metode_pembayaran')->dropDownList(
        ['transfer' => 'Transfer', 'tunai' => 'Tunai'],
        ['prompt' => 'Pilih Metode Pembayaran', 'id' => 'metode-pembayaran']
    ) ?>

    <div id="bukti-pembayaran-field" style="display: none;">
    <?= $form->field($model, 'bukti_transfer')->fileInput()?>
    </div>

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