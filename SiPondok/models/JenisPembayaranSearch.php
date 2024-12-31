<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\JenisPembayaran;

/**
 * JenisPembayaranSearch represents the model behind the search form of `SiPondok\models\JenisPembayaran`.
 */
class JenisPembayaranSearch extends JenisPembayaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jenis'], 'integer'],
            [['nama_pembayaran', 'keterangan'], 'safe'],
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
        $query = JenisPembayaran::find();

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
            'id_jenis' => $this->id_jenis,
        ]);

        $query->andFilterWhere(['like', 'nama_pembayaran', $this->nama_pembayaran])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
