<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\TahunAjaran $model */

$this->title = $model->id_tahun_ajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tahun-ajaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_tahun_ajaran' => $model->id_tahun_ajaran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_tahun_ajaran' => $model->id_tahun_ajaran], [
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
            'id_tahun_ajaran',
            'tahun_ajaran',
        ],
    ]) ?>

</div>
