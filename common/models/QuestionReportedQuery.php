<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[QuestionReported]].
 *
 * @see QuestionReported
 */
class QuestionReportedQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return QuestionReported[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QuestionReported|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
