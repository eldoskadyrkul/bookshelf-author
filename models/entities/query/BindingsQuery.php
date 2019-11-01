<?php

namespace app\models\entities\query;

use Yii;

/**
 * This is the model class for table "bindings".
 *
 * @property int $id
 * @property string $name
 *
 * @property Books[] $books
 */
class BindingsQuery extends \yii\db\ActiveQuery
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
