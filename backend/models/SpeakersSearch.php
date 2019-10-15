<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Speakers;

/**
 * SpeakersSearch represents the model behind the search form of `backend\models\Speakers`.
 */
class SpeakersSearch extends Speakers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_by', 'speaker_role_id'], 'integer'],
            [['speaker_name', 'speaker_details'], 'safe'],
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
        $query = Speakers::find()->orderBy('id',SORT_DESC);                        

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

        $query->andFilterWhere(['like', 'speaker_name', $this->speaker_name])
            ->andFilterWhere(['like', 'speaker_details', $this->speaker_details]);

        return $dataProvider;
    }
}
