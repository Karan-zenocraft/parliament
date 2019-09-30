<?php

namespace common\models;

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
            [['user_agent_id', 'mp_id', 'status', 'is_delete'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question'], 'string', 'max' => 540],
            [['mp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mp_id' => 'id']],
            [['user_agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_agent_id' => 'id']],
        ];
    }

}
