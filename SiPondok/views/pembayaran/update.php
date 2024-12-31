<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */

$this->title = 'Ubah Pembayaran: ' . $model->id_pembayaran;
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pembayaran, 'url' => ['view', 'id_pembayaran' => $model->id_pembayaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
