<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EventLocationBooth;

/**
 * EventLocationBoothSearch represents the model behind the search form of `backend\models\EventLocationBooth`.
 */
class EventLocationBoothSearch extends EventLocationBooth
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_location_id', 'updated_by'], 'integer'],
            [['booth_name', 'booth_detail'], 'safe'],
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
        $query = EventLocationBooth::find();

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
            'event_location_id' => $this->event_location_id,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'booth_name', $this->booth_name])
            ->andFilterWhere(['like', 'booth_detail', $this->booth_detail]);

        return $dataProvider;
    }
}
