<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IsEventExhibitors;

/**
 * IsEventExhibitorsSearch represents the model behind the search form of `backend\models\IsEventExhibitors`.
 */
class IsEventExhibitorsSearch extends IsEventExhibitors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'exhibitor_id'], 'integer'],
            [['exhibitor_join_status', 'comment'], 'safe'],
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
        $query = IsEventExhibitors::find();

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
            'event_id' => $this->event_id,
            'exhibitor_id' => $this->exhibitor_id,
        ]);

        $query->andFilterWhere(['like', 'exhibitor_join_status', $this->exhibitor_join_status])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
