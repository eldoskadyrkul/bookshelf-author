<?php
namespace app\models\entities\query;


class UserQuery extends \yii\db\ActiveQuery
{
    /**
     * @param string $username
     * @return UserQuery
     */
    public function byUsername(string $username): self
    {
        return $this->andWhere(['username' => $username]);
    }
}