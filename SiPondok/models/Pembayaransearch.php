<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\Pembayaran;

/**
 * PembayaranSearch represents the model behind the search form of `SiPondok\models\Pembayaran`.
 */
class PembayaranSearch extends Pembayaran
{
    /**
     * {@inheritdoc}
     */
    public $nis;
    public $nama_santri;
    public $status;

    public function rules()
    {
        return [
            [['id_pembayaran', 'id_jenis', 'id_tahun_ajaran'], 'integer'],
            [['nis', 'nama_santri', 'tanggal_bayar', 'metode_pembayaran', 'bukti_pembayaran', 'bulan', 'status'], 'safe'],
            [['jumlah_bayar'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // Menggunakan joinWith untuk menggabungkan dengan model Santri
        $query = Pembayaran::find()->joinWith('santri'); // Pastikan relasi 'santri' sudah didefinisikan di model Pembayaran

        // Membuat instance ActiveDataProvider untuk menampilkan data dengan pagination
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20, // Sesuaikan jika perlu
            ],
        ]);

        $this->load($params);

        // Jika validasi gagal, kita tidak perlu lanjutkan
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Filter berdasarkan kolom Pembayaran
        $query->andFilterWhere([
            'id_pembayaran' => $this->id_pembayaran,
            'id_jenis' => $this->id_jenis,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'tanggal_bayar' => $this->tanggal_bayar,
            'jumlah_bayar' => $this->jumlah_bayar,
        ]);

        // Filter berdasarkan nis dan nama santri, menggunakan relasi santri
        $query->andFilterWhere(['like', 'santri.nis', $this->nis]) // Filter berdasarkan nis
              ->andFilterWhere(['like', 'santri.nama_santri', $this->nama_santri]) // Filter berdasarkan nama santri
              ->andFilterWhere(['like', 'metode_pembayaran', $this->metode_pembayaran])
              ->andFilterWhere(['like', 'bukti_pembayaran', $this->bukti_pembayaran])
              ->andFilterWhere(['like', 'keterangan', $this->keterangan])
              ->andFilterWhere(['like', 'status', $this->status]);
            
        return $dataProvider;
    }
}