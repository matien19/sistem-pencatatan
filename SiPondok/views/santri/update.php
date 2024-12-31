<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Santri $model */

$this->title = 'Ubah Santri: ' . $model->nis;
$this->params['breadcrumbs'][] = ['label' => 'Santri', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nis, 'url' => ['view', 'nis' => $model->nis]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="santri-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
