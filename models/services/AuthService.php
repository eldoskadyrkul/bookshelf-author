<?php

namespace app\models\services;

use app\models\forms\LoginForm;
use app\models\repo\UserRepository;
use Yii;


class AuthService
{
    private $user;
    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param LoginForm $form
     * @throws \yii\web\NotFoundHttpException
     */

    public function login(LoginForm $form): void
    {
        $user = $this->user->findByUsername($form->username);
        if ($user === null || !$this->validatePassword($form->password, $user->password_hash)) {
            throw new \DomainException('Неверный логин или пароль.');
        }
        Yii::$app->user->login($user, $form->rememberMe ? Yii::$app->params['remember.me'] : 0);
    }

    public function logout(): void
    {
        Yii::$app->user->logout();
    }

    private function validatePassword(string $password, string $password_hash)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $password_hash);
    }
}