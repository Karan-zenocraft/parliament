<?php

namespace common\models;

use common\models\Comments;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CommentsSearch represents the model behind the search form of `common\models\Comments`.
 */
class CommentsSearch extends Comments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'status', 'is_delete'], 'integer'],
            [['comment_text', 'created_at', 'updated_at', 'user_agent_id'], 'safe'],
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
        $query = Comments::find()->leftJoin('questions', 'questions.id=comments.question_id')->where(['question_id' => $_GET['qid'], "questions.is_delete" => 0]);
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
            //'user_agent_id' => $this->user_agent_id,
            'status' => $this->status,
            'is_delete' => $this->is_delete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment_text', $this->comment_text]);
        $query->joinWith(['userAgent' => function ($query) {
            $query->where('users.user_name LIKE "%' . $this->user_agent_id . '%"');
        }]);
        return $dataProvider;
    }
}
