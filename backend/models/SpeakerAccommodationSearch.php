<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SpeakerAccommodation;

/**
 * SpeakerAccommodationSearch represents the model behind the search form of `backend\models\SpeakerAccommodation`.
 */
class SpeakerAccommodationSearch extends SpeakerAccommodation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'speaker_id', 'event_id', 'category_id', 'vendor_id', 'manage_by', 'updated_by'], 'integer'],
            [['category_item', 'category_item_qty'], 'safe'],
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
        $query = SpeakerAccommodation::find();
        
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
            'speaker_id' => $this->speaker_id,
            'event_id' => $this->event_id,
            'category_id' => $this->category_id,
            'vendor_id' => $this->vendor_id,
            'manage_by' => $this->manage_by,
            'updated_by' => $this->updated_by,
        ]);        
        
        $query->andFilterWhere(['like', 'category_item', $this->category_item])->andFilterWhere(['like', 'category_item_qty', $this->category_item_qty]);
        return $dataProvider;
    }
}
