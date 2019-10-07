<?php

namespace common\models\base;

use common\models\Answers;
use common\models\Comments;
use common\models\QuestionLouder;
use common\models\QuestionsQuery;
use common\models\Shares;
use common\models\Users;
use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property integer $user_agent_id
 * @property string $question
 * @property integer $mp_id
 * @property integer $status
 * @property integer $is_delete
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Answers[] $answers
 * @property Comments[] $comments
 * @property QuestionLouder[] $questionLouders
 * @property Users $mp
 * @property Users $userAgent
 * @property Shares[] $shares
 */
class QuestionsBase extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public static function tableName()
    {
        return 'questions';
    }

/**
 * @inheritdoc
 */
    public function rules()
    {
        return [
            [['user_agent_id', 'question', 'mp_id', 'created_at', 'updated_at'], 'required'],
            [['user_agent_id', 'mp_id', 'status', 'is_delete'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question'], 'string', 'max' => 255],
            [['mp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mp_id' => 'id']],
            [['user_agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_agent_id' => 'id']],
        ];
    }

/**
 * @inheritdoc
 */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_agent_id' => 'User Agent ID',
            'question' => 'Question',
            'mp_id' => 'MP',
            'status' => 'Status',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionLouders()
    {
        return $this->hasMany(QuestionLouder::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMp()
    {
        return $this->hasOne(Users::className(), ['id' => 'mp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAgent()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_agent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Shares::className(), ['question_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return QuestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionsQuery(get_called_class());
    }
}
