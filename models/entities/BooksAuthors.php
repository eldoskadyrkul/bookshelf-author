<?php

namespace app\models\entities;


/**
 * This is the model class for table "books_authors".
 *
 * @property int $book_id
 * @property int $author_id
 *
 * @property Authors $author
 * @property Books $book
 */

class BooksAuthors extends \yii\db\ActiveRecord
{
    
    const RELATION_AUTHOR = 'author';
    const RELATION_BOOK = 'book';

    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return '{{%books_authors}}';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
            [['book_id', 'author_id'], 'unique', 'targetAttribute' => ['book_id', 'author_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::class, 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'book_id' => 'Id Book',
            'author_id' => 'Id Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getAuthor()
    {
        return $this->hasOne(Authors::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\entities\query\BooksAuthorsQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new query\BooksAuthorsQuery(get_called_class());
    }
}