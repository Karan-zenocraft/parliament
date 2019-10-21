<?php

namespace common\models\base;

use common\models\AnswersQuery;
use common\models\Questions;
use common\models\Users;
use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $answer_text
 * @property integer $mp_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $mp
 * @property Questions $question
 */
class AnswersBase extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public static function tableName()
    {
        return 'answers';
    }

/**
 * @inheritdoc
 */
    public function rules()
    {
        return [
            [['question_id', 'answer_text', 'mp_id', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'mp_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['answer_text'], 'string', 'max' => 540],
            [['mp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mp_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

/**
 * @inheritdoc
 */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question'),
            'answer_text' => Yii::t('app', 'Answer Text'),
            'mp_id' => Yii::t('app', 'MP'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @inheritdoc
     * @return AnswersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnswersQuery(get_called_class());
    }
}
