<?php

use yii\db\Migration;

/**
 * Class m191030_163138_User
 */
class m191030_163138_User extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'name' =>  $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'access_token'=> $this->string()->defaultValue(null),
            'auth_key' => $this->string()->defaultValue(null),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_163138_User cannot be reverted.\n";

        return false;
    }
    */
}
