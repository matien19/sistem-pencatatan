<?php

use SiPondok\models\Pembayaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var SiPondok\models\PembayaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Input Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pembayaran',

            [
                'label' => 'NIS dan Nama Santri',
                'value' => function ($model) {
                    return $model->santri ? $model->santri->nis . ' - ' . $model->santri->nama_santri : 'Tidak ada';
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
                'filter' => Html::activeTextInput($searchModel, 'nis', [
                    'class' => 'form-control',
                    'placeholder' => ''
                ]),
            ],

            [
                'label' => 'Jenis Pembayaran',
                'value' => function ($model) {
                    return $model->jenisPembayaran ? $model->jenisPembayaran->nama_pembayaran : 'Tidak ada';
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
            ],
            
            'bulan',
            'id_tahun_ajaran',
            'tanggal_bayar',
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->status;
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
                'contentOptions' => function ($model) {
                    return ['class' => $model->status === 'Lunas' ? 'status-lunas' : ''];
                },
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pembayaran $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_pembayaran' => $model->id_pembayaran]);
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
                    'cetak' => function ($url, $model) {
                            return Html::a('<i class="fas fa-print"></i>', ['cetak-kwitansi', 'id_pembayaran' => $model->id_pembayaran], [
                                'class' => 'btn btn-info btn-sm',
                                'title' => 'Cetak Kwitansi',
                                'data-pjax' => '0',
                                'target' => '_blank',
                            ]);
                    },
                ],
                'template' => '{view} {update} {delete} {cetak}',
                'headerOptions' => ['style' => 'width:150px; text-align:center;'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>