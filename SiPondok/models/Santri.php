<?php

namespace SiPondok\models;

use Yii;

/**
 * This is the model class for table "santri".
 *
 * @property string $nis
 * @property string $nama_santri
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property int $id_kelas
 * @property string $alamat
 * @property string $no_hp
 * @property string $tahun_angkatan
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
            [['nis', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'id_kelas', 'alamat', 'no_hp', 'tahun_angkatan', 'status'], 'required'],
            [['jenis_kelamin', 'alamat', 'status'], 'string'],
            [['tanggal_lahir', 'tahun_angkatan'], 'safe'],
            [['id_kelas'], 'integer'],
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
            'id_kelas' => 'Id Kelas',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'tahun_angkatan' => 'Tahun Angkatan',
            'status' => 'Status',
        ];
    }

    public function getKelas()
    {
        return $this->hasMany(Kelas::class, ['id_kelas' => 'nama_kelas']);
    }

    public function getTagihan()
    {
        return $this->hasMany(Tagihan::class, ['nis' => 'nis']);
    }

}
