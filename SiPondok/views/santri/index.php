<?php

use SiPondok\models\Santri;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\SantriSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Santri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="santri-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Santri', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nis',
            'nama_santri',
            'jenis_kelamin',
            'tanggal_lahir',
            'id_kelas',
            //'alamat:ntext',
            //'no_hp',
            //'tahun_angkatan',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Santri $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nis' => $model->nis]);
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
