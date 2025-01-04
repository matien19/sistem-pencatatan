<?php

use SiPondok\models\Tagihan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\TagihanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tagihans';
$this->params['breadcrumbs'][] = $this->title;

$nis = Yii::$app->user->identity->username;  

$belumLunasCount = Tagihan::find()->where(['status_tagihan' => 'belum lunas', 'nis' => $nis])->count();
$validasiCount = Tagihan::find()->where(['status_tagihan' => 'validasi', 'nis' => $nis])->count();
$lunasCount = Tagihan::find()->where(['status_tagihan' => 'lunas', 'nis' => $nis])->count();
?>
<div class="tagihan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Belum Lunas (' . $belumLunasCount . ')', ['index', 'status_tagihan' => 'belum lunas'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Validasi (' . $validasiCount . ')', ['index', 'status_tagihan' => 'validasi'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Lunas (' . $lunasCount . ')', ['index', 'status_tagihan' => 'lunas'], ['class' => 'btn btn-success']) ?>

    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'NIS dan Nama Santri',
                'value' => function ($model) {
                    return $model->santri ? $model->santri->nis .' - '. $model->santri->nama_santri : 'Tidak ada';
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
                'filter' => Html::activeTextInput($searchModel, 'nis', [
                    'class' => 'form-control',
                    'placeholder' => ''
                ]),
            ],
            [
                'label' => 'Jenis Tagihan',
                'value' => function ($model) {
                    return $model->jenisPembayaran ? $model->jenisPembayaran->nama_pembayaran : 'Tidak ada';
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
            ],
            [
                'label' => 'Tahun Ajaran',
                'value' => function ($model) {
                    return $model->tahunAjaran ? $model->tahunAjaran->tahun_ajaran : 'Tidak ada';
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold;'],
            ],
            'jumlah_tagihan',
            [
                'attribute' => 'status_tagihan',
                'format' => 'html',
                'value' => function ($model) {
                    $status = $model->status_tagihan;
                    $badgeClass = '';
            
                    switch ($status) {
                        case 'Belum Lunas':
                            $badgeClass = 'badge badge-danger';
                            break;
                        case 'Validasi':
                            $badgeClass = 'badge badge-warning';
                            break;
                        case 'Lunas':
                            $badgeClass = 'badge badge-success';
                            break;
                        default:
                            $badgeClass = 'badge badge-secondary';
                            break;
                    }
            
                    return Html::tag('span', ucfirst($status), ['class' => $badgeClass]);
                },
                'headerOptions' => ['style' => 'color: #007bff; font-weight: bold; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            'keterangan:ntext',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}', 
                'urlCreator' => function ($action, Tagihan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_tagihan' => $model->id_tagihan]);
                },
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Lihat Detail', $url, [
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Lihat Detail',
                        ]);
                    },
                ],
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
