<?php

namespace common\models\base;

use Yii;
use common\models\Questions;
use common\models\Users;

/**
 * This is the model class for table "comments".
*
    * @property integer $id
    * @property integer $question_id
    * @property string $comment_text
    * @property integer $user_agent_id
    * @property integer $status
    * @property integer $is_delete
    * @property string $created_at
    * @property string $updated_at
    *
            * @property Questions $question
            * @property Users $userAgent
    */
class CommentsBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'comments';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['question_id', 'comment_text', 'user_agent_id', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'user_agent_id', 'status', 'is_delete'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment_text'], 'string', 'max' => 255],
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
    'comment_text' => Yii::t('app', 'Comment Text'),
    'user_agent_id' => Yii::t('app', 'User Agent ID'),
    'status' => Yii::t('app', 'Status'),
    'is_delete' => Yii::t('app', 'Is Delete'),
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
     * @return CommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentsQuery(get_called_class());
}
}