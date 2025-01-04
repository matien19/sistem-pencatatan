<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id_pembayaran
 * @property string $nis
 * @property int $id_tagihan
 * @property int $id_tahun_ajaran
 * @property string $tanggal_bayar
 * @property float $jumlah_bayar
 * @property string $metode_pembayaran
 * @property string|null $bukti_pembayaran
 * @property string|null $keterangan
 * @property string|null $status
 */
class Pembayaran extends \yii\db\ActiveRecord
{
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
            [['id_tagihan', 'id_tahun_ajaran', 'tanggal_bayar', 'jumlah_bayar', 'metode_pembayaran'], 'required'],
            [['id_tagihan', 'id_tahun_ajaran'], 'integer'],
            [['tanggal_bayar'], 'safe'],
            [['jumlah_bayar'], 'number'],
            [['metode_pembayaran', 'keterangan', 'status'], 'string'],
            [['bukti_pembayaran'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pembayaran' => 'Id Pembayaran',
            'id_tagihan' => 'Id Tagihan',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'tanggal_bayar' => 'Tanggal Bayar',
            'jumlah_bayar' => 'Jumlah Bayar',
            'metode_pembayaran' => 'Metode Pembayaran',
            'bukti_pembayaran' => 'Bukti Pembayaran',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
        ];
    }
    public function getTagihan()
    {
        return $this->hasOne(Tagihan::class, ['id_tagihan' => 'id_tagihan']);
    }
    public function getTahunAjaran()
    {
        return $this->hasOne(TahunAjaran::class, ['id_tahun_ajaran' => 'id_tahun_ajaran']);
    }
}
