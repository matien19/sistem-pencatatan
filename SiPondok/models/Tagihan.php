<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "tagihan".
 *
 * @property int $id_tagihan
 * @property string $nis
 * @property int $id_jenis
 * @property int $id_tahun_ajaran
 * @property float $jumlah_tagihan
 * @property string $status_tagihan
 * @property string $keterangan
 */
class Tagihan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['nis', 'id_jenis', 'id_tahun_ajaran', 'jumlah_tagihan', 'status_tagihan', 'keterangan'], 'required'],
            [['id_tahun_ajaran'], 'integer'],
            [['jumlah_tagihan'], 'number'],
            [['status_tagihan', 'keterangan'], 'string'],
            [['nis'], 'string', 'max' => 8],
            [['id_jenis'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tagihan' => 'Id Tagihan',
            'nis' => 'Nis',
            'id_jenis' => 'Id Jenis',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'jumlah_tagihan' => 'Jumlah Tagihan',
            'status_tagihan' => 'Status Tagihan',
            'keterangan' => 'Keterangan',
        ];
    }

    public function getSantri()
    {
        return $this->hasOne(Santri::class, ['nis' => 'nis']);
    }

    public function getJenisPembayaran()
    {
        return $this->hasOne(JenisPembayaran::class, ['id_jenis' => 'id_jenis']);
    }

    public function getTahunAjaran()
    {
        return $this->hasOne(TahunAjaran::class, ['id_tahun_ajaran' => 'id_tahun_ajaran']);
    }
}
