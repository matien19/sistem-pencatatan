<?php
$this->title='DASHBOARD';

$this->params['breadcrumbs']=[['label'=>$this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            Selamat datang <strong><?= Yii::$app->user->identity->username ?></strong>
        </div>
    </div>
</div>