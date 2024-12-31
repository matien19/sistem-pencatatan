<?php

namespace SiPondok\controllers;

use SiPondok\models\TahunAjaran;
use SiPondok\models\TahunAjaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TahunAjaranController implements the CRUD actions for TahunAjaran model.
 */
class TahunAjaranController extends Controller
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
     * Lists all TahunAjaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TahunAjaranSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TahunAjaran model.
     * @param int $id_tahun_ajaran Id Tahun Ajaran
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tahun_ajaran)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_tahun_ajaran),
        ]);
    }

    /**
     * Creates a new TahunAjaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TahunAjaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_tahun_ajaran' => $model->id_tahun_ajaran]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TahunAjaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_tahun_ajaran Id Tahun Ajaran
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tahun_ajaran)
    {
        $model = $this->findModel($id_tahun_ajaran);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_tahun_ajaran' => $model->id_tahun_ajaran]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TahunAjaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tahun_ajaran Id Tahun Ajaran
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tahun_ajaran)
    {
        $this->findModel($id_tahun_ajaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TahunAjaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tahun_ajaran Id Tahun Ajaran
     * @return TahunAjaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tahun_ajaran)
    {
        if (($model = TahunAjaran::findOne(['id_tahun_ajaran' => $id_tahun_ajaran])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
