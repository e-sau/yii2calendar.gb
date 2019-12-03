<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m191130_163038_create_indexes_to_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-started_at-activity', '{{%activity}}', 'started_at');
        $this->createIndex('idx-created_at-activity', '{{%activity}}', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-started_at-activity', '{{%activity}}');
        $this->dropIndex('idx-created_at-activity', '{{%activity}}');
    }
}
