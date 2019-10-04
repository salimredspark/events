<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hotels;

/**
 * HotelsSearch represents the model behind the search form of `backend\models\Hotels`.
 */
class HotelsSearch extends Hotels
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_by'], 'integer'],
            [['hotel_name', 'hotel_address', 'hotel_website', 'hotel_detail'], 'safe'],
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
        $query = Hotels::find()->orderBy('id',SORT_DESC);

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
            'id' => $this->id,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'hotel_name', $this->hotel_name])
            ->andFilterWhere(['like', 'hotel_address', $this->hotel_address])
            ->andFilterWhere(['like', 'hotel_website', $this->hotel_website])
            ->andFilterWhere(['like', 'hotel_detail', $this->hotel_detail]);

        return $dataProvider;
    }
}
