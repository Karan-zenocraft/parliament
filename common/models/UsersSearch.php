<?php

namespace common\models;

use common\models\Users;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsersSearch represents the model behind the search form of `common\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'age', 'years_hopr', 'badge_count', 'status'], 'integer'],
            [['email', 'password', 'user_name', 'city', 'gender', 'education', 'password_reset_token', 'standing_commitee', 'created_at', 'updated_at'], 'safe'],
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
        $query = Users::find()->where("role_id != " . Yii::$app->params['userroles']['admin']);

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
            'role_id' => $this->role_id,
            'age' => $this->age,
            'years_hopr' => $this->years_hopr,
            'badge_count' => $this->badge_count,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'standing_commitee', $this->standing_commitee]);

        return $dataProvider;
    }
}
