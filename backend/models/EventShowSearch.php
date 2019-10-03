<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EventShow;

/**
 * EventShowSearch represents the model behind the search form of `backend\models\EventShow`.
 */
class EventShowSearch extends EventShow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'updated_by'], 'integer'],
            [['show_name', 'show_location', 'show_description', 'start_time', 'end_time'], 'safe'],
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
        $query = EventShow::find()->orderBy('id',SORT_DESC);

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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'event_id' => $this->event_id,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'show_name', $this->show_name])
            ->andFilterWhere(['like', 'show_location', $this->show_location])
            ->andFilterWhere(['like', 'show_description', $this->show_description]);

        return $dataProvider;
    }
}
