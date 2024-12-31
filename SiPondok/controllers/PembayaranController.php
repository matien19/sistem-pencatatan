<?php

namespace SiPondok\controllers;

use SiPondok\models\JenisPembayaran;
use SiPondok\models\Pembayaran;
use SiPondok\models\PembayaranSearch;
use SiPondok\models\Santri;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PembayaranController implements the CRUD actions for Pembayaran model.
 */
class PembayaranController extends Controller
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
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pembayaran model.
     * @param int $id_pembayaran Id Pembayaran
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pembayaran)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_pembayaran),
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
        $model->tanggal_bayar = date('Y-m-d');
        $model->status = 'Lunas';
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Validasi jenis pembayaran untuk kolom bulan
                if ($model->id_jenis) {
                    $jenisPembayaran = JenisPembayaran::findOne($model->id_jenis);
                    if ($jenisPembayaran && $jenisPembayaran->nama_pembayaran === 'Spp syariah') {
                        $model->bulan = $this->request->post('Pembayaran')['bulan'] ?? null;
                    } else {
                        $model->bulan = null; // Kosongkan jika bukan Spp Syariah
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Jenis pembayaran tidak ditemukan.');
                    return $this->redirect(['create']);
                }
    
                // Penanganan file upload jika metode pembayaran adalah transfer
                if ($model->metode_pembayaran === 'transfer') {
                    $uploadedFile = UploadedFile::getInstance($model, 'bukti_transfer'); // Pastikan menggunakan 'bukti_transfer'
                    if ($uploadedFile) {
                        $targetDirectory = Yii::getAlias('@webroot/uploads/');
                        $filePath = $targetDirectory . $uploadedFile->baseName . '.' . $uploadedFile->extension;
    
                        // Buat folder jika belum ada
                        if (!is_dir($targetDirectory)) {
                            mkdir($targetDirectory, 0777, true);
                        }
    
                        // Simpan file dan tambahkan ke model
                        if ($uploadedFile->saveAs($filePath)) {
                            $model->bukti_transfer = 'uploads/' . $uploadedFile->baseName . '.' . $uploadedFile->extension;
                        } else {
                            Yii::$app->session->setFlash('error', 'Gagal mengunggah bukti pembayaran.');
                            return $this->redirect(['create']);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Bukti pembayaran tidak ditemukan.');
                        return $this->redirect(['create']);
                    }
                } else {
                    $model->bukti_transfer = null; // Tidak diperlukan untuk tunai
                }
    
                // Simpan data jika valid
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Pembayaran berhasil disimpan.');
                    return $this->redirect(['view', 'id_pembayaran' => $model->id_pembayaran]);
                } else {
                    Yii::$app->session->setFlash('error', 'Gagal menyimpan pembayaran.');
                }
            }
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

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        // Setelah data berhasil disimpan, redirect ke halaman view
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

    public function actionCetakKwitansi($id_pembayaran)
    {
    $model = $this->findModel($id_pembayaran);

    // Render ke view khusus untuk kwitansi
    return $this->render('kwitansi', [
        'model' => $model,
    ]);
    }

    public function actionKwitansiPdf($id)
{
    $model = $this->findModel($id);
    $content = $this->renderPartial('kwitansi', ['model' => $model]); // Template kwitansi

    $pdf = new \Mpdf\Mpdf();
    $pdf->WriteHTML($content);
    return $pdf->Output('Kwitansi-Pembayaran-' . $model->id_pembayaran . '.pdf', \Mpdf\Output\Destination::INLINE);
}


    /**
     * Finds the Pembayaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pembayaran Id Pembayaran
     * @return Pembayaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembayaran::findOne($id)) !== null) {
            return $model;
        }

        // Jika data tidak ditemukan, lempar error 404
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
