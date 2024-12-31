<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\JenisPembayaran $model */

$this->title = 'Tambah Jenis Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
