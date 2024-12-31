<?php

use SiPondok\models\JenisPembayaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\JenisPembayaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jenis Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Jenis Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_jenis',
            'nama_pembayaran',
            'nominal',
            // 'keterangan:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JenisPembayaran $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_jenis' => $model->id_jenis]);
                },
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'class' => 'btn btn-success btn-sm',
                            'title' => 'Lihat',
                            'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, [
                            'class' => 'btn btn-primary btn-sm',
                            'title' => 'Ubah',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Hapus',
                            'data' => [
                                'confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                'method' => 'post',
                            ],
                            'data-pjax' => '0',
                        ]);
                    },
                ],
                'template' => '{view} {update} {delete}',
                'headerOptions' => ['style' => 'width:150px; text-align:center;'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
