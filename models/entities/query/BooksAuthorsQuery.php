<?php

namespace app\models\entities\query;

use Yii;

class BooksAuthorsQuery extends \yii\db\ActiveQuery
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
     * @return \app\models\entities\Books[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * {@inheritdoc}
     * @return \app\models\entities\Books|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
