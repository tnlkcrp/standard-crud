<?php

use yii\db\Migration;

/**
 * Class m190828_065509_create_table_users
 */
class m190828_065509_create_table_users extends Migration
{
    const TABLE_NAME = 'users';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
