<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m190327_150337_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'status_project_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('{{%project_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)
        ]);

        $this->createIndex("ix_project_status", "project", 'status_project_id');
        $this->createIndex("ix_project_creator", "project", 'creator_id');

        $this->addForeignKey('fk_project_statuses', "{{%project}}",
            'status_project_id', "{{%project_status}}", 'id');
        $this->addForeignKey('fk_project_creator_id', "{{%project}}",
            'creator_id', "{{%users}}", 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_status}}');
        $this->dropTable('{{%project}}');
    }
}
