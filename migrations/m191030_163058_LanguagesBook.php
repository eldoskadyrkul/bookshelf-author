<?php

use yii\db\Migration;

/**
 * Class m191030_163058_LanguagesBook
 */
class m191030_163058_LanguagesBook extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_163058_LanguagesBook cannot be reverted.\n";

        return false;
    }
    */
}
