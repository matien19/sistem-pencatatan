<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaran $model */

$this->title = 'Update Histori Pembayaran: ' . $model->id_histori;
$this->params['breadcrumbs'][] = ['label' => 'Histori Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_histori, 'url' => ['view', 'id_histori' => $model->id_histori]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="histori-pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
