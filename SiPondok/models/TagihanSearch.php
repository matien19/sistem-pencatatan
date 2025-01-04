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

        // Menambahkan kondisi yang selalu diterapkan
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        $this->load($params);
    
        if (!$this->validate()) {
            // Jika validasi gagal, tidak mengembalikan data
            return $dataProvider;
        }
    
        // Kondisi grid filter
        $query->andFilterWhere([
            'id_tagihan' => $this->id_tagihan,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'jumlah_tagihan' => $this->jumlah_tagihan,
        ]);
    
        // Menambahkan filter berdasarkan status_tagihan jika diberikan
        if (!empty($this->status_tagihan)) {
            $query->andFilterWhere(['status_tagihan' => $this->status_tagihan]);
        }
    
        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'id_jenis', $this->id_jenis])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);
    
        return $dataProvider;
    }
}
