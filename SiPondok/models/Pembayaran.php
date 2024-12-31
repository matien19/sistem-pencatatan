<?php

namespace SiPondok\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id_pembayaran
 * @property string $nis
 * @property int $id_jenis
 * @property int $id_tahun_ajaran
 * @property string $tanggal_bayar
 * @property float $jumlah_bayar
 * @property string $metode_pembayaran
 * @property string $bukti_pembayaran
 * @property string $keterangan
 * @property string $status
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    public $bukti_transfer;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    return [
        // Kolom wajib diisi
        [['nis', 'id_jenis', 'id_tahun_ajaran', 'tanggal_bayar', 'jumlah_bayar', 'metode_pembayaran'], 'required'],
        
        ['bulan', 'required', 'when' => function ($model) {
            $jenisPembayaran = JenisPembayaran::findOne($model->id_jenis);
            return $jenisPembayaran && $jenisPembayaran->nama_pembayaran === 'Spp syariah';
        }, 'whenClient' => "function (attribute, value) {
            return $('#jenis-pembayaran').find(':selected').text() === 'Spp syariah';
        }"],
        [['tahun_ajaran'], 'string', 'max' => 9],
        ['bulan', 'string', 'max' => 20],
        [['id_jenis', 'id_tahun_ajaran'], 'integer'],
        [['tanggal_bayar'], 'safe'],
        [['jumlah_bayar'], 'number'],
        [['metode_pembayaran', 'keterangan'], 'string'],
        [['nis'], 'string', 'max' => 8],
        // ['bukti_pembayaran', 'required', 'when' => function ($model) {
        //     return $model->metode_pembayaran === 'transfer';
        // }, 'whenClient' => "function (attribute, value) {
        //     return $('#metode-pembayaran').val() === 'transfer';
        // }"],
        ['bukti_transfer', 'file','skipOnEmpty' => true, 'extensions' => 'jpg, png, jpeg', 'maxSize' => 1024 * 1024 * 2],
        [['status'], 'default', 'value' => 'Lunas'],
        [['id_pembayaran'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id_pembayaran' => 'Id Pembayaran',
            'nis' => 'Nis',
            'id_jenis' => 'Id Jenis',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'tanggal_bayar' => 'Tanggal Bayar',
            'jumlah_bayar' => 'Jumlah Bayar',
            'metode_pembayaran' => 'Metode Pembayaran',
            'bukti_pembayaran' => 'Bukti Pembayaran',
            // 'keterangan' => 'Keterangan',
        ];
    }

    public function beforeSave($insert)
    {
        $parent = parent::beforeSave($insert);

        $file = UploadedFile::getInstance($this, 'bukti_transfer');

        if (!empty($file)) {
            $uploadPath = Yii::getAlias('@webroot/uploads/');

            $newName = uniqid() . '_' . $file->baseName . '.' . $file->extension;

            $filePath = $uploadPath . $newName;

            if ($file->saveAs($filePath))  {
                $this->bukti_pembayaran = $newName;
            }
        }

    if ($insert) { // Jika data baru
        $this->tanggal_bayar = date('Y-m-d');
    }

        return $parent;
    }

    public function getSantri()
    {
        return $this->hasOne(Santri::class, ['nis' => 'nis']);
    }

    public function getByJenisPembayaran($id_jenis)
    {
        return self::find()
        ->joinWith('santri')
        ->where(['id_jenis' => $id_jenis])
        ->all();
    }

    public function getJenisPembayaran()
    {
    return $this->hasOne(JenisPembayaran::className(), ['id_jenis' => 'id_jenis']);
    }

    public function getTahunAjaran()
    {
        return $this->tahun_ajaran; 
    }

    public function getTagihan()
    {
        return $this->hasOne(Tagihan::class, ['id_tagihan' => 'id_tagihan']);
    }

}
