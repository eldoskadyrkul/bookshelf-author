<?php

namespace app\models\entities;

use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $password_hash
 * @property string $access_token
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 */

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_NEW_USER = 'new-user';
    const SCENARIO_UPDATE_PROFILE = 'update-profile';
    const SCENARIO_UPDATE_PASSWORD = 'update-password';
    public $password;
    public $passwordRepeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }
    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                if (self::find()->byUsername($this->username)->one()) {
                    \Yii::$app->session->setFlash('error', "Пользователь с логином {$this->username} уже существует!");
                    return false;
                }
                $this->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $this->auth_key = \Yii::$app->security->generateRandomString(32);
                $this->access_token = \Yii::$app->security->generateRandomString(32);
            } elseif ($this->getScenario() == self::SCENARIO_UPDATE_PASSWORD) {
                $this->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }
    /**
     * @return array
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_NEW_USER => ['username', 'name', 'password', 'passwordRepeat'],
            self::SCENARIO_UPDATE_PASSWORD => ['password', 'passwordRepeat'],
            self::SCENARIO_UPDATE_PROFILE => ['name']
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'name', 'password', 'passwordRepeat'], 'required'],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'name', 'password', 'passwordRepeat', 'password_hash', 'access_token', 'auth_key'], 'string', 'max' => 255],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'name' => 'Имя пользователя',
            'password' => 'Пароль',
            'passwordRepeat' => 'Пароль повторно',
            'password_hash' => 'Password Hash',
            'access_token' => 'Токен доступа',
            'auth_key' => 'Auth Key',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
    
    public static function find()
    {
        return new query\UserQuery(static::class);
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'name'
        ];
    }
}