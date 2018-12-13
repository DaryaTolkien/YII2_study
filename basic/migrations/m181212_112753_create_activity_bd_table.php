<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activity`.
 */
class m181212_112753_create_activity_bd_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->createTable('activity_bd', [
        'id_activity' => $this->primaryKey(),
        'activity_name' => $this->string(255)->notNull(),
        'activity_start_timestamp' => $this->timestamp()->defaultExpression("now()"),
        'activity_end_timestamp' => $this->timestamp()->defaultExpression("now()"),
        'id_user' => $this->integer(),
        'body' => $this->text()
    ]);
 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
    }
}
