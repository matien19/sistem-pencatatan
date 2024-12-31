<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\TahunAjaran $model */

$this->title = 'Ubah Tahun Ajaran: ' . $model->id_tahun_ajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tahun_ajaran, 'url' => ['view', 'id_tahun_ajaran' => $model->id_tahun_ajaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tahun-ajaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
