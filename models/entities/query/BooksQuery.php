<?php

namespace app\models\entities\query;

use Yii;

class BooksQuery extends \yii\db\ActiveQuery
{
    /**
     * @param $id
     * @return BooksQuery
     */

    public function byId($id)
    {
        return $this->where(['books.id' => $id]);
    }
    
    /**
     * {@inheritdoc}
     * @return \app\core\entities\BooksAuthors[]|array
     */

    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\core\entities\BooksAuthors|array|null
     */
    
    public function one($db = null)
    {
        return parent::one($db);
    }
}
