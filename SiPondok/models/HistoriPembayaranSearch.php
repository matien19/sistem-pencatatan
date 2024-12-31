<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\HistoriPembayaran;

/**
 * HistoriPembayaranSearch represents the model behind the search form of `SiPondok\models\HistoriPembayaran`.
 */
class HistoriPembayaranSearch extends HistoriPembayaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_histori', 'id_pembayaran'], 'integer'],
            [['nis', 'tanggal_bayar', 'jenis_pembayaran', 'admin_pencatat', 'keterangan', 'waktu_dibuat'], 'safe'],
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
        $query = HistoriPembayaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_histori' => $this->id_histori,
            'id_pembayaran' => $this->id_pembayaran,
            'tanggal_bayar' => $this->tanggal_bayar,
            'jumlah_bayar' => $this->jumlah_bayar,
            'waktu_dibuat' => $this->waktu_dibuat,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'jenis_pembayaran', $this->jenis_pembayaran])
            ->andFilterWhere(['like', 'admin_pencatat', $this->admin_pencatat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
