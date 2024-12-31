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
?>
<div class="tagihan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tagihan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tagihan',
            'nis',
            'id_jenis:ntext',
            'id_tahun_ajaran',
            'jumlah_tagihan',
            //'status_tagihan',
            //'keterangan:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tagihan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_tagihan' => $model->id_tagihan]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
