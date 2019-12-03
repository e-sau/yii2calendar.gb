<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m191130_163847_add_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'username', $this->string());
        $this->addColumn('{{%user}}', 'password', $this->string());
        $this->addColumn('{{%user}}', 'auth_key', $this->string());
        $this->addColumn('{{%user}}', 'access_token', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'username');
        $this->dropColumn('{{%user}}', 'password');
        $this->dropColumn('{{%user}}', 'auth_key');
        $this->dropColumn('{{%user}}', 'access_token');
    }
}
