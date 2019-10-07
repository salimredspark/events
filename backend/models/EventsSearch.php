<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Events;

/**
 * EventsSearch represents the model behind the search form of `backend\models\Events`.
 */
class EventsSearch extends Events
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_name', 'event_type_id', 'updated_by'], 'integer'],
            [['event_domain_name', 'event_location', 'event_description', 'start_time', 'end_time'], 'safe'],
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
        $query = Events::find()->orderBy('start_time',SORT_ASC);

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
            'event_name' => $this->event_name,
            'event_type_id' => $this->event_type_id,
            'event_location' => $this->event_location,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'event_domain_name', $this->event_domain_name])
            ->andFilterWhere(['like', 'event_description', $this->event_description]);

        return $dataProvider;
    }
}
