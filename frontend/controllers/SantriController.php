<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class SantriController extends Controller
{
    public function actionIndex()
    {
        //URL :..../index.php?r=santri
        echo "<p>Ini URL: <strong>" . Yii::$app->request->absoluteUrl . "</srtong></p>";
        echo "<p><strong> Ini adalah URL DEFAULT</strong></p>";
    }

    public function actionView($id)
    {
        echo "<p>Ini URL: <strong>" . Yii::$app->request->absoluteUrl . "</srtong></p>";
        echo "<p>Santri dengan No ID: <strong>$id</strong>";
    }
}