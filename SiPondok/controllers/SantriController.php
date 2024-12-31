<?php

namespace SiPondok\controllers;

use SiPondok\models\Santri;
use SiPondok\models\SantriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SantriController implements the CRUD actions for Santri model.
 */
class SantriController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Santri models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SantriSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Santri model.
     * @param string $nis Nis
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nis)
    {
        return $this->render('view', [
            'model' => $this->findModel($nis),
        ]);
    }

    /**
     * Creates a new Santri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Santri();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nis' => $model->nis]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Santri model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nis Nis
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nis)
    {
        $model = $this->findModel($nis);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nis' => $model->nis]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Santri model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nis Nis
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nis)
    {
        $this->findModel($nis)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Santri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nis Nis
     * @return Santri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nis)
    {
        if (($model = Santri::findOne(['nis' => $nis])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
