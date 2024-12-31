<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "histori_pembayaran".
 *
 * @property int $id_histori
 * @property int $id_pembayaran
 * @property string $nis
 * @property string $tanggal_bayar
 * @property float $jumlah_bayar
 * @property string $jenis_pembayaran
 * @property string $admin_pencatat
 * @property string $keterangan
 * @property string $waktu_dibuat
 */
class HistoriPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembayaran', 'nis', 'tanggal_bayar', 'jumlah_bayar', 'jenis_pembayaran', 'admin_pencatat', 'keterangan', 'waktu_dibuat'], 'required'],
            [['id_pembayaran'], 'integer'],
            [['tanggal_bayar', 'waktu_dibuat'], 'safe'],
            [['jumlah_bayar'], 'number'],
            [['keterangan'], 'string'],
            [['nis'], 'string', 'max' => 8],
            [['jenis_pembayaran'], 'string', 'max' => 50],
            [['admin_pencatat'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_histori' => 'Id Histori',
            'id_pembayaran' => 'Id Pembayaran',
            'nis' => 'Nis',
            'tanggal_bayar' => 'Tanggal Bayar',
            'jumlah_bayar' => 'Jumlah Bayar',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'admin_pencatat' => 'Admin Pencatat',
            'keterangan' => 'Keterangan',
            'waktu_dibuat' => 'Waktu Dibuat',
        ];
    }
}
