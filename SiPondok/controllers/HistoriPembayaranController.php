<?php

namespace SiPondok\controllers;

use SiPondok\models\HistoriPembayaran;
use SiPondok\models\HistoriPembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HistoriPembayaranController implements the CRUD actions for HistoriPembayaran model.
 */
class HistoriPembayaranController extends Controller
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
     * Lists all HistoriPembayaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HistoriPembayaranSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HistoriPembayaran model.
     * @param int $id_histori Id Histori
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_histori)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_histori),
        ]);
    }

    /**
     * Creates a new HistoriPembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new HistoriPembayaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_histori' => $model->id_histori]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HistoriPembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_histori Id Histori
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_histori)
    {
        $model = $this->findModel($id_histori);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_histori' => $model->id_histori]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HistoriPembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_histori Id Histori
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_histori)
    {
        $this->findModel($id_histori)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HistoriPembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_histori Id Histori
     * @return HistoriPembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_histori)
    {
        if (($model = HistoriPembayaran::findOne(['id_histori' => $id_histori])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
