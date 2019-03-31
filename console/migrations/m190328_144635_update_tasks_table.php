<?php

use yii\db\Migration;

/**
 * Class m190328_144635_update_tasks_table
 */
class m190328_144635_update_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tasks}}', 'project_id', $this->integer());

        $this->createIndex("ix_project_id", "{{%tasks}}", 'project_id');
        $this->addForeignKey('fk_task_project_id',"{{%tasks}}",
            'project_id', "{{%project}}", 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tasks}}', 'created_at');
    }

}
