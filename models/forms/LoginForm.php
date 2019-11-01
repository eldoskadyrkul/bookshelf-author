<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        $rules = [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];

        return $rules;
    }

    public function reset()
    {
        $this->password = '';
    }

    /**
     * @return array
     */

    public function attributeLabels()
    {
        $label = [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];

        return $label;
    }
}
