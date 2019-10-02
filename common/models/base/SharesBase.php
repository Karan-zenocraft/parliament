<?php

namespace common\models\base;

use common\models\Questions;
use common\models\SharesQuery;
use common\models\Users;
use Yii;

/**
 * This is the model class for table "shares".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_agent_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Questions $question
 * @property Users $userAgent
 */
class SharesBase extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public static function tableName()
    {
        return 'shares';
    }

/**
 * @inheritdoc
 */
    public function rules()
    {
        return [
            [['question_id', 'user_agent_id', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'user_agent_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['user_agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_agent_id' => 'id']],
        ];
    }

/**
 * @inheritdoc
 */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'user_agent_id' => Yii::t('app', 'User Agent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAgent()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_agent_id']);
    }

    /**
     * @inheritdoc
     * @return SharesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SharesQuery(get_called_class());
    }
}
