<?php

namespace common\models\base;

use Yii;
use common\models\Questions;
use common\models\Users;

/**
 * This is the model class for table "question_louder".
*
    * @property integer $id
    * @property integer $question_id
    * @property integer $user_id
    * @property string $created_at
    * @property string $updated_at
    *
            * @property Questions $question
            * @property Users $user
    */
class QuestionLouderBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'question_louder';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['question_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
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
    'user_id' => Yii::t('app', 'User ID'),
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
    public function getUser()
    {
    return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return QuestionLouderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionLouderQuery(get_called_class());
}
}