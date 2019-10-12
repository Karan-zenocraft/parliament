<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "question_hide".
*
    * @property integer $id
    * @property integer $user_id
    * @property string $questions_id
    * @property string $created_at
    * @property string $updated_by
*/
class QuestionHideBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'question_hide';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['id', 'user_id', 'questions_id', 'created_at', 'updated_by'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['questions_id'], 'string'],
            [['created_at', 'updated_by'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('app', 'ID'),
    'user_id' => Yii::t('app', 'User ID'),
    'questions_id' => Yii::t('app', 'Questions ID'),
    'created_at' => Yii::t('app', 'Created At'),
    'updated_by' => Yii::t('app', 'Updated By'),
];
}

    /**
     * @inheritdoc
     * @return QuestionHideQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionHideQuery(get_called_class());
}
}