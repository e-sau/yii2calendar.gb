<?php

use yii\db\Migration;

/**
 * Class m191204_061713_modify_user_table `{{%user}}`.
 */
class m191204_061713_modify_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'email', $this->string()->notNull()->unique());
        $this->addColumn('{{%user}}', 'created_at', $this->integer()->notNull());
        $this->addColumn('{{%user}}', 'updated_at', $this->integer()->notNull());
        $this->addColumn('{{%user}}', 'status', $this->smallInteger()->notNull()->defaultValue(10));
        $this->renameColumn('{{%user}}', 'password', 'password_hash');
        $this->renameColumn('{{%user}}', 'access_token', 'password_reset_token');
        $this->alterColumn('{{%user}}', 'username', $this->string()->notNull()->unique());
        $this->alterColumn('{{%user}}', 'password_reset_token', $this->string()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'email');
        $this->dropColumn('{{%user}}', 'created_at');
        $this->dropColumn('{{%user}}', 'updated_at');
        $this->dropColumn('{{%user}}', 'status');
        $this->renameColumn('{{%user}}', 'password_hash', 'password');
        $this->renameColumn('{{%user}}', 'password_reset_token', 'access_token');
        $this->dropIndex('username', '{{%user}}');
        $this->dropIndex('password_reset_token', '{{%user}}');
    }
}
