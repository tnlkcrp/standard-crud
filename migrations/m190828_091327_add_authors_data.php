<?php

use yii\db\Migration;

/**
 * Class m190828_091327_add_authors_data
 */
class m190828_091327_add_authors_data extends Migration
{
    const TABLE_NAME = 'authors';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            self::TABLE_NAME,
            ['name'],
            [
                ['Пушкин'],
                ['Толстой'],
                ['Достоевский'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190828_091327_add_authors_data cannot be reverted.\n";
    }
}
