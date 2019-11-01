<?php

use yii\db\Migration;

/**
 * Class m191030_163022_Bindings
 */
class m191030_163022_Bindings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bindings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bindings}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_163022_Bindings cannot be reverted.\n";

        return false;
    }
    */
}
