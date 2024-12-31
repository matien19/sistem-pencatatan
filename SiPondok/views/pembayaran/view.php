<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */

$this->title = $model->id_pembayaran;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pembayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_pembayaran' => $model->id_pembayaran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_pembayaran' => $model->id_pembayaran], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah kamu yakin ingin menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pembayaran',
            'nis',
            'id_jenis',
            'id_tahun_ajaran',
            'tanggal_bayar',
            'jumlah_bayar',
            'metode_pembayaran',
            [
                'attribute' => 'bukti_pembayaran',
                'format' => 'raw',
                'value' => function ($model) {
                    // Jika metode pembayaran adalah transfer dan bukti pembayaran ada, tampilkan gambar
                    if ($model->metode_pembayaran === 'transfer' && !empty($model->bukti_pembayaran)) {
                        return Html::img(Yii::getAlias('@web/uploads/') . $model->bukti_pembayaran, ['height' => '200px']);
                    }
                    return 'Tidak ada bukti pembayaran';
                },
            ],
            // 'keterangan:ntext',
        ],
    ]) ?>

</div>

<?php
$script = <<<JS
    // Menambahkan event listener untuk perubahan metode pembayaran
    $('#metode-pembayaran').on('change', function() {
        var metode = $(this).val();
        if (metode === 'transfer') {
            $('#bukti-pembayaran-field').show(); // Tampilkan input file bukti pembayaran
        } else {
            $('#bukti-pembayaran-field').hide(); // Sembunyikan input file bukti pembayaran
        }
    });

    // Cek status awal metode pembayaran saat halaman pertama kali dimuat
    if ($('#metode-pembayaran').val() === 'transfer') {
        $('#bukti-pembayaran-field').show(); // Tampilkan jika sudah transfer
    } else {
        $('#bukti-pembayaran-field').hide(); // Sembunyikan jika tidak transfer
    }
JS;
$this->registerJs($script);
?>