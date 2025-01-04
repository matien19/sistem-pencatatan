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
    public function rules()
    {
        return [
            [['id_pembayaran', 'id_tagihan', 'id_tahun_ajaran'], 'integer'],
            [['tanggal_bayar', 'metode_pembayaran', 'bukti_pembayaran', 'keterangan', 'status'], 'safe'],
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
        $query = Pembayaran::find();

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
            'id_pembayaran' => $this->id_pembayaran,
            'id_tagihan' => $this->id_tagihan,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'tanggal_bayar' => $this->tanggal_bayar,
            'jumlah_bayar' => $this->jumlah_bayar,
        ]);

        $query->andFilterWhere(['like', 'metode_pembayaran', $this->metode_pembayaran])
            ->andFilterWhere(['like', 'bukti_pembayaran', $this->bukti_pembayaran])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
