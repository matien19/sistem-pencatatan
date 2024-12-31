<?php

use SiPondok\models\HistoriPembayaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Histori Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="histori-pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Histori Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_histori',
            'id_pembayaran',
            'nis',
            'tanggal_bayar',
            'jumlah_bayar',
            //'jenis_pembayaran',
            //'admin_pencatat',
            //'keterangan:ntext',
            //'waktu_dibuat',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HistoriPembayaran $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_histori' => $model->id_histori]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
