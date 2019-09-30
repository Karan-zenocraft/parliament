<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Answers]].
 *
 * @see Answers
 */
class AnswersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Answers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Answers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
