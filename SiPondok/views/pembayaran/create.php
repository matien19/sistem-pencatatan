<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Pembayaran $model */

$this->title = 'Input Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
