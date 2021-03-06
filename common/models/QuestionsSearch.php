<?php

namespace common\models;

use common\models\Questions;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * QuestionsSearch represents the model behind the search form of `common\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', /*'user_agent_id', 'mp_id', */'status', 'is_delete'], 'integer'],
            [['question', 'created_at', 'updated_at', 'user_agent_id', 'mp_id'], 'safe'],
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
        $query = Questions::find()->where("is_delete != '1'");

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
            // 'user_agent_id' => $this->user_agent_id,
            //  'mp_id' => $this->mp_id,
            'status' => $this->status,
            'is_delete' => $this->is_delete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question]);
        $query->andFilterWhere(['in', 'mp_id', $this->mp_id]);
        $query->joinWith(['userAgent' => function ($query) {
            $query->where('users.user_name LIKE "%' . $this->user_agent_id . '%"');
        }]);

        return $dataProvider;
    }
}
