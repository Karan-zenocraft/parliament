<?php

namespace common\models;

use common\models\Answers;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AnswersSearch represents the model behind the search form of `common\models\Answers`.
 */
class AnswersSearch extends Answers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id'], 'integer'],
            [['answer_text', 'created_at', 'updated_at', 'mp_id'], 'safe'],
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
        $query = Answers::find()->leftJoin('questions', 'questions.id=answers.question_id')
            ->where(["questions.is_delete" => 0, "answers.question_id" => $_GET['qid']]);

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
            'question_id' => $this->question_id,
            //'mp_id' => $this->mp_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'answer_text', $this->answer_text]);
        $query->joinWith(['mp' => function ($query) {
            $query->where('users.user_name LIKE "%' . $this->mp_id . '%"');
        }]);
        return $dataProvider;
    }
}
