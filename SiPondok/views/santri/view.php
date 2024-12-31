<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var SiPondok\models\Santri $model */

$this->title = $model->nis;
$this->params['breadcrumbs'][] = ['label' => 'Santri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="santri-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'nis' => $model->nis], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'nis' => $model->nis], [
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
            'nis',
            'nama_santri',
            'jenis_kelamin',
            'tanggal_lahir',
            'id_kelas',
            'alamat:ntext',
            'no_hp',
            'tahun_angkatan',
            'status',
        ],
    ]) ?>

</div>
