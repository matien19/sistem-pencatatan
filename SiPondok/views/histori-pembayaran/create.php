<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\HistoriPembayaran $model */

$this->title = 'Create Histori Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Histori Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="histori-pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
