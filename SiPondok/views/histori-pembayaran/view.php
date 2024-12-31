<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaran $model */

$this->title = $model->id_histori;
$this->params['breadcrumbs'][] = ['label' => 'Histori Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="histori-pembayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_histori' => $model->id_histori], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_histori' => $model->id_histori], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_histori',
            'id_pembayaran',
            'nis',
            'tanggal_bayar',
            'jumlah_bayar',
            'jenis_pembayaran',
            'admin_pencatat',
            'keterangan:ntext',
            'waktu_dibuat',
        ],
    ]) ?>

</div>
