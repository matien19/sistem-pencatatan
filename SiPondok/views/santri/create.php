<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var SiPondok\models\Santri $model */

$this->title = 'Tambah Santri';
$this->params['breadcrumbs'][] = ['label' => 'Santri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="santri-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
