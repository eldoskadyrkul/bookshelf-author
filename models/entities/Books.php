<?php

namespace app\models\entities;
use yii\helpers\Url;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $pages
 * @property string $isbn
 * @property int $language_id
 * @property int $binding_id
 * @property int $weight
 *
 * @property Bindings $binding
 * @property Languages $language
 * @property Authors[] $authors
 */

class Books extends \yii\db\ActiveRecord
{
    const RELATION_BINDING = 'binding';
    const RELATION_LANGUAGE = 'language';
    const RELATION_AUTHORS = 'authors';

    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['name', 'pages', 'isbn', 'language_id', 'binding_id', 'weight'], 'required'],
            [['pages', 'language_id', 'binding_id', 'weight'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 75],
            [['isbn'], 'string', 'max' => 17],
            [['binding_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bindings::class, 'targetAttribute' => ['binding_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBooks::class, 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название книги',
            'image' => 'Обложка',
            'pages' => 'Страниц',
            'isbn' => 'ISBN',
            'language_id' => 'Язык',
            'binding_id' => 'Переплет',
            'weight' => 'Вес',
            'authors.name' => 'Авторство'
        ];
    }

    public function getImage()
    {
        return ($this->image ? Url::to("@upload/books/{$this->image}") : Url::to('@upload/noimage.jpg'));
    }

    public function getBinding()
    {
        return $this->hasOne(Bindings::class, ['id' => 'binding_id']);
    }

    public function getLanguage()
    {
        return $this->hasOne(LanguageBooks::class, ['id' => 'language_id']);
    }

    public function getAuthors()
    {
        return $this->hasMany(Authors::class, ['id' => 'author_id'])->viaTable('books_authors', ['book_id' => 'id']);
    }

    public static function find()
    {
        return new query\BooksQuery(get_called_class());
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'image' => function (Books $model) {
                return $model->getImage();
            },
            'pages',
            'isbn',
            'weight',
            'language',
            'binding',
            'authors'
        ];
    }
}