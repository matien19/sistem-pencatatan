<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "tagihan_jenis_pembayaran".
 *
 * @property int $tagihan_id
 * @property int $jenis_pembayaran_id
 *
 * @property JenisPembayaran $jenisPembayaran
 * @property Tagihan $tagihan
 */
class TagihanJenisPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_jenis_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tagihan_id', 'jenis_pembayaran_id'], 'required'],
            [['tagihan_id', 'jenis_pembayaran_id'], 'integer'],
            [['tagihan_id', 'jenis_pembayaran_id'], 'unique', 'targetAttribute' => ['tagihan_id', 'jenis_pembayaran_id']],
            [['tagihan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tagihan::class, 'targetAttribute' => ['tagihan_id' => 'id_tagihan']],
            [['jenis_pembayaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisPembayaran::class, 'targetAttribute' => ['jenis_pembayaran_id' => 'id_jenis']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tagihan_id' => 'Tagihan ID',
            'jenis_pembayaran_id' => 'Jenis Pembayaran ID',
        ];
    }

    /**
     * Gets query for [[JenisPembayaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJenisPembayaran()
    {
        return $this->hasOne(JenisPembayaran::class, ['id_jenis' => 'jenis_pembayaran_id']);
    }

    /**
     * Gets query for [[Tagihan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTagihan()
    {
        return $this->hasOne(Tagihan::class, ['id_tagihan' => 'tagihan_id']);
    }
}
