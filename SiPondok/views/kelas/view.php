<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\Kelas $model */

$this->title = $model->id_kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kelas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'id_kelas' => $model->id_kelas], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id_kelas' => $model->id_kelas], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Arpakah kamu yakin ingin menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_kelas',
            'nama_kelas',
        ],
    ]) ?>

</div>
