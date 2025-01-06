<?php

namespace SiPondok\controllers;

use SiPondok\models\Pembayaran;
use SiPondok\models\PembayaranSearch;
use SiPondok\models\TahunAjaran;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PembayaranController implements the CRUD actions for Pembayaran model.
 */
class LaporanPembayaranController extends Controller
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
     * Lists all Pembayaran models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PembayaranSearch();

        $idTahunAjaran = $this->request->get('id_tahun_ajaran');
        
        Yii::debug("Filter applied for id_tahun_ajaran: " . $idTahunAjaran);  
        $dataTahunAjaran = ArrayHelper::map(TahunAjaran::find()->all(), 'id_tahun_ajaran', 'tahun_ajaran');

        $pembayaran = Pembayaran::find()
            ->joinWith(['tagihan.santri'])  
            ->where(['pembayaran.status' => 'Lunas']); 

        if ($idTahunAjaran) {
            $pembayaran->andWhere(['pembayaran.id_tahun_ajaran' => $idTahunAjaran]);
            
        }

        $pembayaran = $pembayaran->all();

        return $this->render('index', [
            'pembayaran' => $pembayaran,
            'dataTahunAjaran' => $dataTahunAjaran,
        ]);
    }

    /**
     * Displays a single Pembayaran model.
     * @param int $id_pembayaran Id Pembayaran
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tahun_ajaran = null, $bulan = null)
    {
        $dataTahunAjaran = ArrayHelper::map(TahunAjaran::find()->all(), 'id_tahun_ajaran', 'tahun_ajaran');
    
        $query = Pembayaran::find()
            ->joinWith(['tagihan.santri']) 
            ->where(['pembayaran.status' => 'Lunas']);
    
        if ($id_tahun_ajaran) {
            $query->andWhere(['pembayaran.id_tahun_ajaran' => $id_tahun_ajaran]);
        }
    
        if ($bulan) {
            $query->andWhere(['MONTH(pembayaran.tanggal_bayar)' => $bulan]);
        }
    
        $pembayaran = $query->all();
    
        return $this->render('view', [
            'pembayaran' => $pembayaran,
            'dataTahunAjaran' => $dataTahunAjaran,
        ]);
    }

    /**
     * Creates a new Pembayaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pembayaran();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_pembayaran' => $model->id_pembayaran]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pembayaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pembayaran Id Pembayaran
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pembayaran)
    {
        $model = $this->findModel($id_pembayaran);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pembayaran' => $model->id_pembayaran]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pembayaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pembayaran Id Pembayaran
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pembayaran)
    {
        $this->findModel($id_pembayaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pembayaran Id Pembayaran
     * @return Pembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pembayaran)
    {
        if (($model = Pembayaran::findOne(['id_pembayaran' => $id_pembayaran])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
