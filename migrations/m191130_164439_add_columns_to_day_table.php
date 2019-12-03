<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%day}}`.
 */
class m191130_164439_add_columns_to_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%day}}', 'name', $this->string());
        $this->addColumn('{{%day}}', 'workday', $this->boolean());
        $this->addColumn('{{%day}}', 'activities', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%day}}', 'name');
        $this->dropColumn('{{%day}}', 'workday');
        $this->dropColumn('{{%day}}', 'activities');
    }
}
