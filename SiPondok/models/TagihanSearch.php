<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\Tagihan;

/**
 * TagihanSearch represents the model behind the search form of `SiPondok\models\Tagihan`.
 */
class TagihanSearch extends Tagihan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tagihan', 'id_tahun_ajaran'], 'integer'],
            [['nis', 'id_jenis', 'status_tagihan', 'keterangan'], 'safe'],
            [['jumlah_tagihan'], 'number'],
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
        $query = Tagihan::find();

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
            'id_tagihan' => $this->id_tagihan,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'jumlah_tagihan' => $this->jumlah_tagihan,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'id_jenis', $this->id_jenis])
            ->andFilterWhere(['like', 'status_tagihan', $this->status_tagihan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
