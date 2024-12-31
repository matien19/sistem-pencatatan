<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\JenisPembayaran $model */

$this->title = $model->id_jenis;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jenis-pembayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_jenis' => $model->id_jenis], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_jenis' => $model->id_jenis], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah kamu yakin ingi menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jenis',
            'nama_pembayaran',
            'nominal',
            // 'keterangan:ntext',
        ],
    ]) ?>

</div>
