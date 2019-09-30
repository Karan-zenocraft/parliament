<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[QuestionLouder]].
 *
 * @see QuestionLouder
 */
class QuestionLouderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return QuestionLouder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return QuestionLouder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
