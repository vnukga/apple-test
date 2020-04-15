<?php

namespace backend\modules\apple\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\apple\models\Apple;

/**
 * AppleSearch represents the model behind the search form of `backend\modules\apple\models\Apple`.
 */
class AppleSearch extends Apple
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'appeared_at', 'falled_at', 'eaten', 'status'], 'integer'],
            [['color'], 'safe'],
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
        $query = Apple::find();

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
            'appeared_at' => $this->appeared_at,
            'falled_at' => $this->falled_at,
            'eaten' => $this->eaten,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
