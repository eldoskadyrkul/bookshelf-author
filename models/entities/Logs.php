<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int $type
 * @property string $module
 * @property string $message
 * @property string $created_at
 */

class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['type', 'module', 'message', 'created_at'], 'required'],
            [['type'], 'integer'],
            [['module', 'message', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'module' => 'Module',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }
}
