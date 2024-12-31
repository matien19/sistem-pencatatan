<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "log_pembayaran".
 *
 * @property int $id_log
 * @property int $id_pembayaran
 * @property int $id_admin
 * @property string $tanggal_perubahan
 * @property int $keterangan
 */
class LogPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_log', 'id_pembayaran', 'id_admin', 'tanggal_perubahan', 'keterangan'], 'required'],
            [['id_log', 'id_pembayaran', 'id_admin', 'keterangan'], 'integer'],
            [['tanggal_perubahan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'id_pembayaran' => 'Id Pembayaran',
            'id_admin' => 'Id Admin',
            'tanggal_perubahan' => 'Tanggal Perubahan',
            'keterangan' => 'Keterangan',
        ];
    }
}
