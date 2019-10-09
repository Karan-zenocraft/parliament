<?php

namespace common\models;

use common\components\Common;
use Yii;

class Questions extends \common\models\base\QuestionsBase
{

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->setAttribute('created_at', date('Y-m-d H:i:s'));
        }
        $this->setAttribute('updated_at', date('Y-m-d H:i:s'));

        return parent::beforeSave($insert);
    }
    public function rules()
    {
        return [
            [['question'], 'required'],
            [['mp_id'], 'required', "message" => "Please select atleast one MP"],
            [['user_agent_id', 'status', 'is_delete'], 'integer'],
            [['created_at', 'updated_at', 'mp_id'], 'safe'],
            [['question'], 'string', 'max' => 540],
            [['question'], "validateCount"],
            //  [['mp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mp_id' => 'id']],
            //[['user_agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_agent_id' => 'id']],
        ];
    }
    public function validateCount($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $monday = Common::getLastMondaySaturday("monday");
            $saturday = Common::getLastMondaySaturday("saturday");
            $query = Questions::find()->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0]);
            $query->andWhere(['between', 'created_at', $monday, $saturday]);
            $questionCount = $query->count();
            if ($questionCount == 10) {
                $this->addError($attribute, 'You can not ask question as question limit reaches of this week');
                //}else if (!$user || ($user->role_id != Yii::$app->params['userroles']['teachers'] && $user->role_id != Yii::$app->params['userroles']['student'])) {
            } else {
                //$user->last_login = date('Y-m-d H:i:s');
                //$user->is_logged_in = '1';
                //$user->save();
            }
        }
    }

}
