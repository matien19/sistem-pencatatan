<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property int $id_tahun_ajaran
 * @property string $tahun_ajaran
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun_ajaran', 'tahun_ajaran'], 'required'],
            [['id_tahun_ajaran'], 'integer'],
            [['tahun_ajaran'], 'string', 'max' => 9],
            [['id_tahun_ajaran'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'tahun_ajaran' => 'Tahun Ajaran',
        ];
    }

    public function getTagihan()
{
    return $this->hasMany(Tagihan::class, ['id_tahun_ajaran' => 'id_tahun_ajaran']);
}

}
