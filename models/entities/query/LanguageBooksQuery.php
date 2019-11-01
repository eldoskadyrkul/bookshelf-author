<?php

namespace app\models\entities\query;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $name
 *
 * @property Books[] $books
 */
class LanguageBooksQuery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['language_id' => 'id']);
    }
}
