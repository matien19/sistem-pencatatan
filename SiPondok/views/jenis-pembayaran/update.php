<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\JenisPembayaran $model */

$this->title = 'Ubah Jenis Pembayaran: ' . $model->id_jenis;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jenis, 'url' => ['view', 'id_jenis' => $model->id_jenis]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
