<?php

namespace SiPondok\controllers;

use SiPondok\models\JenisPembayaran;
use SiPondok\models\JenisPembayaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenisPembayaranController implements the CRUD actions for JenisPembayaran model.
 */
class JenisPembayaranController extends Controller
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
     * Lists all JenisPembayaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JenisPembayaranSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenisPembayaran model.
     * @param int $id_jenis Id Jenis
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_jenis)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_jenis),
        ]);
    }

    /**
     * Creates a new JenisPembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JenisPembayaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_jenis' => $model->id_jenis]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JenisPembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_jenis Id Jenis
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_jenis)
    {
        $model = $this->findModel($id_jenis);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_jenis' => $model->id_jenis]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JenisPembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_jenis Id Jenis
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_jenis)
    {
        $this->findModel($id_jenis)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenisPembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_jenis Id Jenis
     * @return JenisPembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_jenis)
    {
        if (($model = JenisPembayaran::findOne(['id_jenis' => $id_jenis])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
