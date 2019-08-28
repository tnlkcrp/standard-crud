<?php

use yii\db\Migration;

/**
 * Class m190828_091819_create_table_books
 */
class m190828_091819_create_table_books extends Migration
{
    const TABLE_NAME = 'books';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'genre' => $this->string()->notNull(),
            'tag' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci');

        $this->addForeignKey(
            'fk_user_id',
            self::TABLE_NAME,
            'user_id',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
