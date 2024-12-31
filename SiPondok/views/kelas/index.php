<?php

use SiPondok\models\Kelas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\KelasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Kelas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_kelas',
            'nama_kelas',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Kelas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_kelas' => $model->id_kelas]);
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
