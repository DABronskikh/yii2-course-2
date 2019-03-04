<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m190220_143738_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex("ix_file_image", '{{%files}}', 'task_id');
        $this->addForeignKey('fk_file_image_task_id','{{%files}}', 'task_id', "{{%tasks}}", 'id');
        $this->addForeignKey('fk_file_image_creator_id','{{%files}}', 'creator_id', "{{%users}}", 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
