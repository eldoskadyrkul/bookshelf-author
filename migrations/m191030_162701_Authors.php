<?php

use yii\db\Migration;

/**
 * Class m191030_162701_Authors
 */
class m191030_162701_Authors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_162701_Authors cannot be reverted.\n";

        return false;
    }
    */
}
