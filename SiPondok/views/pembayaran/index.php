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

$this->title = 'Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'tanggal_bayar',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->tanggal_bayar, 'php:d F Y H:i') . ' WIB';
                },
                'format' => 'raw', 
            ],
            'jumlah_bayar',
            'metode_pembayaran',
            'keterangan:ntext',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    $status = $model->status;
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
            [
                'class' => ActionColumn::className(),
                'template' => '{view}', 
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_pembayaran' => $model->id_pembayaran]);
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
