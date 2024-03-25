<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rand_numbers}}`.
 */
class m240325_210234_create_rand_numbers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rand_numbers}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rand_numbers}}');
    }
}
