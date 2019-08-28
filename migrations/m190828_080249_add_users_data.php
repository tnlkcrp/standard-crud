<?php

use yii\db\Migration;

/**
 * Class m190828_080249_add_users_data
 */
class m190828_080249_add_users_data extends Migration
{
    const TABLE_NAME = 'users';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            [
                'admin',
                'admin@example.com',
                '$2y$13$Qmm9lneVDDNy9FjnETlzQO12xx3hti1iMveo6i7gjiw4Nywawf9GS',
                'G7F_ol4RHELAkXG02K8fViYYM8JGx6Pj',
            ],
            [
                'moder',
                'moder@example.com',
                '$2y$13$CJRIp8XIaMefAa9rsdK.zOTKkmyELVip7D23CxHI.Ar1eY1Ywp5cS',
                'Q0XvDImzLc-3Kfg5Fykzmb6LAooPtbGK',
            ],
        ];

        $this->batchInsert(
            self::TABLE_NAME,
            [
                'username',
                'email',
                'password_hash',
                'auth_key',
            ],
            $data
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190828_080249_add_users_data cannot be reverted.\n";
    }
}
