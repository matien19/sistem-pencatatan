<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Kelas $model */

$this->title = 'Update Kelas: ' . $model->id_kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kelas, 'url' => ['view', 'id_kelas' => $model->id_kelas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kelas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
