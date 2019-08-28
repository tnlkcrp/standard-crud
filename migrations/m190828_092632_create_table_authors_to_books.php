<?php

use yii\db\Migration;

/**
 * Class m190828_092632_create_table_authors_to_books
 */
class m190828_092632_create_table_authors_to_books extends Migration
{
    const TABLE_NAME = 'authors_to_books';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_author_id',
            self::TABLE_NAME,
            'author_id',
            'authors',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_book_id',
            self::TABLE_NAME,
            'book_id',
            'books',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $sql = 'CREATE TABLE smth (id int unsigned not null auto_increment primary key, some_id int unsigned, another_id int)';
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
