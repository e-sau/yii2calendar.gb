<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%day}}`.
 */
class m191130_164203_create_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%day}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%day}}');
    }
}
