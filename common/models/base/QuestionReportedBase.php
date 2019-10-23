<?php

namespace common\models\base;

use common\models\QuestionReportedQuery;
use Yii;

/**
 * This is the model class for table "question_reported".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_id
 * @property string $report_comment
 * @property string $created_at
 * @property string $updated_at
 */
class QuestionReportedBase extends \yii\db\ActiveRecord
{
/**
 * @inheritdoc
 */
    public static function tableName()
    {
        return 'question_reported';
    }

/**
 * @inheritdoc
 */
    public function rules()
    {
        return [
            [['question_id', 'user_id', 'report_comment', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'user_id'], 'integer'],
            [['report_comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'report_comment' => Yii::t('app', 'Report Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return QuestionReportedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionReportedQuery(get_called_class());
    }
}
