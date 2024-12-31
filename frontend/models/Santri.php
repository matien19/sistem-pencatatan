<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "santri".
 *
 * @property string $nis
 * @property string $nama_santri
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $no_hp
 * @property string $status
 */
class Santri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'santri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nis', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_hp', 'status'], 'required'],
            [['jenis_kelamin', 'alamat', 'status'], 'string'],
            [['tanggal_lahir'], 'safe'],
            [['nis'], 'string', 'max' => 8],
            [['nama_santri'], 'string', 'max' => 250],
            [['no_hp'], 'string', 'max' => 15],
            [['nis'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nis' => 'Nis',
            'nama_santri' => 'Nama Santri',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'status' => 'Status',
        ];
    }
}
