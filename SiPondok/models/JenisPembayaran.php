<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "jenis_pembayaran".
 *
 * @property int $id_jenis
 * @property string $nama_pembayaran
 * @property string $keterangan
 */
class JenisPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jenis', 'nama_pembayaran', 'nominal'], 'required'],
            [['id_jenis'], 'integer'],
            [['nominal'], 'number'],
            // [['keterangan'], 'string'],
            [['nama_pembayaran'], 'string', 'max' => 50],
            [['id_jenis'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jenis' => 'Id Jenis',
            'nama_pembayaran' => 'Nama Pembayaran',
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
        ];
    }

    public function getTagihan()
    {
    return $this->hasMany(Tagihan::class, ['id_jenis' => 'id_jenis']);
    }

}
