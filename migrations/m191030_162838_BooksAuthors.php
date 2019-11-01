<?php

use yii\db\Migration;

/**
 * Class m191030_162838_BooksAuthors
 */
class m191030_162838_BooksAuthors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books_authors}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);
        
        $this->addForeignKey('{{%fk-books_authors-book_id}}', '{{%books_authors}}', 'book_id', '{{%books}}', 'id', 'RESTRICT');
        $this->addForeignKey('{{%fk-books_authors-binding_id}}', '{{%books_authors}}', 'author_id', '{{%authors}}', 'id', 'RESTRICT');
        $this->createIndex('{{%idx-books_authors-book_id}}', '{{%books_authors}}', 'book_id');
        $this->createIndex('{{%idx-books_authors-author_id}}', '{{%books_authors}}', 'author_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191030_162838_BooksAuthors cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_162838_BooksAuthors cannot be reverted.\n";

        return false;
    }
    */
}
