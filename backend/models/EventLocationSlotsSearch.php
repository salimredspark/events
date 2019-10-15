<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EventLocationSlots;

/**
 * EventLocationSlotsSearch represents the model behind the search form of `backend\models\EventLocationSlots`.
 */
class EventLocationSlotsSearch extends EventLocationSlots
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_location_id', 'updated_by'], 'integer'],
            [['slot_name', 'slot_detail', 'slot_available'], 'safe'],
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
        $query = EventLocationSlots::find();

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

        $query->andFilterWhere(['like', 'slot_name', $this->slot_name])
            ->andFilterWhere(['like', 'slot_detail', $this->slot_detail]);

        return $dataProvider;
    }
}
