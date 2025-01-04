<?php

namespace SiPondok\controllers;

use PhpParser\Node\Stmt\If_;
use SiPondok\models\Pembayaran;
use SiPondok\models\Tagihan;
use SiPondok\models\TagihanSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TagihanController implements the CRUD actions for Tagihan model.
 */
class TagihanSantriController extends Controller
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
     * Lists all Tagihan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TagihanSearch();

        $statusTagihan = Yii::$app->request->get('status_tagihan', null);
    
        $nis = Yii::$app->user->identity->username; 
        $queryParams = Yii::$app->request->queryParams;
        
        if ($statusTagihan) {
            $queryParams['TagihanSearch']['status_tagihan'] = $statusTagihan;
        }
    
        $queryParams['TagihanSearch']['nis'] = $nis; 
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tagihan model.
     * @param int $id_tagihan Id Tagihan
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tagihan)
    {
        $pembayaranModel = new Pembayaran();  
        $pembayaranTagihanModel = Pembayaran::find()->where(['id_tagihan' => $id_tagihan])->one();
        
        if ($this->request->post()) {
            $pembayaranModel->load(Yii::$app->request->post());
            $dateTimeNow = date('Y-m-d H:i:s');
          
            $chek = Pembayaran::find()->where(['id_tagihan' => $pembayaranModel->id_tagihan])->one();
            if ($chek) {
                Yii::$app->session->setFlash('error', 'Tagihan sudah pernah dibayar.');
                return $this->redirect(['tagihan-santri/view', 'id_tagihan' => $id_tagihan]);
            }

            $pembayaranModel->id_tagihan = $id_tagihan;
            $pembayaranModel->tanggal_bayar = $dateTimeNow;
            $pembayaranModel->status = 'Validasi';
            $pembayaranModel->metode_pembayaran = 'transfer';

            // Handle file upload
            $uploadedFile = UploadedFile::getInstance($pembayaranModel, 'bukti_pembayaran');
            if ($uploadedFile) {
                $filePath = 'uploads/' . uniqid() . '.' . $uploadedFile->extension;
                if ($uploadedFile->saveAs($filePath)) {
                    $pembayaranModel->bukti_pembayaran = $filePath;
                } else {
                    Yii::$app->session->setFlash('error', 'Gagal mengunggah file bukti pembayaran.');
                    return $this->redirect(['tagihan/index']);
                }
            }

            if ($pembayaranModel->save()) {
                // Update tagihan status
                $tagihanModel = Tagihan::findOne($pembayaranModel->id_tagihan);
                if ($tagihanModel) {
                    $tagihanModel->status_tagihan = 'Validasi';
                    if ($tagihanModel->save(false)) {
                        Yii::$app->session->setFlash('success', 'Pembayaran berhasil diproses.');
                    } else {
                        Yii::$app->session->setFlash('error', 'Gagal memperbarui status tagihan.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Tagihan tidak ditemukan.');
                }
                return $this->redirect(['tagihan-santri/index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data pembayaran.');
            }
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id_tagihan),
            'pembayaranModel' => $pembayaranModel,
            'pembayaranTagihanModel' => $pembayaranTagihanModel,
        ]);
    }

    /**
     * Creates a new Tagihan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tagihan();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->status_tagihan = 'Belum Lunas';
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Tagiham berhasil disimpan.');
                return $this->redirect(['view', 'id_tagihan' => $model->id_tagihan]);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan Tagiham.');
            }
        } else {
            $model->loadDefaultValues();

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tagihan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_tagihan Id Tagihan
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tagihan)
    {
        $model = $this->findModel($id_tagihan);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_tagihan' => $model->id_tagihan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tagihan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tagihan Id Tagihan
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tagihan)
    {
        $this->findModel($id_tagihan)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Tagihan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tagihan Id Tagihan
     * @return Tagihan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tagihan)
    {
        if (($model = Tagihan::findOne(['id_tagihan' => $id_tagihan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
