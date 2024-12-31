<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\Tagihan $model */

$this->title = $model->id_tagihan;
$this->params['breadcrumbs'][] = ['label' => 'Tagihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tagihan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_tagihan' => $model->id_tagihan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_tagihan' => $model->id_tagihan], [
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
            'id_tagihan',
            'nis',
            'id_jenis:ntext',
            'id_tahun_ajaran',
            'jumlah_tagihan',
            'status_tagihan',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
