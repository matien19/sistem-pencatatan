<?php

namespace SiPondok\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use SiPondok\models\Santri;

/**
 * SantriSearch represents the model behind the search form of `SiPondok\models\Santri`.
 */
class SantriSearch extends Santri
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nis', 'nama_santri', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_hp', 'tahun_angkatan', 'status'], 'safe'],
            [['id_kelas'], 'integer'],
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
        $query = Santri::find();

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
            'tanggal_lahir' => $this->tanggal_lahir,
            'id_kelas' => $this->id_kelas,
            'tahun_angkatan' => $this->tahun_angkatan,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'nama_santri', $this->nama_santri])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
