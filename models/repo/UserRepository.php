<?php


namespace app\models\repo;


use app\models\entities\User;
use yii\web\NotFoundHttpException;


class UserRepository
{
    /**
     * @param string $username
     * @return User
     * @throws NotFoundHttpException
     */
    public function findByUsername(string $username): User 
    {
        if (($model = User::find()->byUsername($username)->limit(1)->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('User not found.');
    }
}