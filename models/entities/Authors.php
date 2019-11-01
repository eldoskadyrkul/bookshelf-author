<?php

namespace app\models\entities;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 */
class Authors extends \yii\db\ActiveRecord
{
    const RELATION_BOOKS = 'books';
    
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'authors';
    }
    
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя автора',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['id' => 'book_id'])->viaTable('books_authors', ['author_id' => 'id']);
    }
    
        
    public static function find()
    {
        return new query\AuthorsQuery(get_called_class());
    }
}
