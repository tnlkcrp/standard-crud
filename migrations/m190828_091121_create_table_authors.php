<?php

use yii\db\Migration;

/**
 * Class m190828_091121_create_table_authors
 */
class m190828_091121_create_table_authors extends Migration
{
    const TABLE_NAME = 'authors';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
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
