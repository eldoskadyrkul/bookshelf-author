<?php

namespace app\models\entities\query;

use Yii;


class AuthorsQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    
    /**
     * {@inheritdoc}
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
