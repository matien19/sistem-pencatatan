<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id_kelas
 * @property string $nama_kelas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kelas', 'nama_kelas'], 'required'],
            [['id_kelas'], 'integer'],
            [['nama_kelas'], 'string', 'max' => 15],
            [['id_kelas'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kelas' => 'Id Kelas',
            'nama_kelas' => 'Nama Kelas',
        ];
    }

    public function getSantri()
    {
        return $this->hasMany(Kelas::class, ['nis' => 'nis']);
    }
}
