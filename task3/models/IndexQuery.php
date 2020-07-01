<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Index]].
 *
 * @see Index
 */
class IndexQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Index[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Index|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
