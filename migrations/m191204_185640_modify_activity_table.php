<?php

use yii\db\Migration;

/**
 * Class m191204_185640_modify_activity_table
 * Handles adding columns to table `{{%activity}}`.
 */
class m191204_185640_modify_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%activity}}', 'title', $this->string()->notNull());
        $this->alterColumn('{{%activity}}', 'started_at', $this->integer()->notNull());
        $this->alterColumn('{{%activity}}', 'finished_at', $this->integer()->notNull());
        $this->alterColumn('{{%activity}}', 'user_id', $this->integer()->notNull());
        $this->alterColumn('{{%activity}}', 'repeat', $this->tinyInteger(1));
        $this->alterColumn('{{%activity}}', 'created_at', $this->integer()->notNull());
        $this->alterColumn('{{%activity}}', 'updated_at', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191204_185640_modify_activity_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191204_185640_modify_activity_table cannot be reverted.\n";

        return false;
    }
    */
}
