<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\TahunAjaran;

/**
 * TahunAjaranSearch represents the model behind the search form of `SiPondok\models\TahunAjaran`.
 */
class TahunAjaranSearch extends TahunAjaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tahun_ajaran'], 'integer'],
            [['tahun_ajaran'], 'safe'],
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
        $query = TahunAjaran::find();

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
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
        ]);

        $query->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran]);

        return $dataProvider;
    }
}
