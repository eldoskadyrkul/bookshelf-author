<?php

use yii\db\Migration;

/**
 * Class m191030_163812_Logs
 */
class m191030_163812_Logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logs}}', [
            'id' => $this->primaryKey(),
            'type' => $this->smallInteger()->notNull(),
            'module' => $this->string()->notNull(),
            'message' => $this->string()->notNull(),
            'created_at' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logs}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_163812_Logs cannot be reverted.\n";

        return false;
    }
    */
}
