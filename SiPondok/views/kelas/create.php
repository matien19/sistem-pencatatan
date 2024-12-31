<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Kelas $model */

$this->title = 'Tambah Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
