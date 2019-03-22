<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_subscription}}`.
 */
class m190317_175449_create_telegram_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_subscription}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'telegram_user_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex("ix_telegram_user_id", "{{%telegram_subscription}}", 'telegram_user_id');

        $this->addForeignKey('fk_telegram_subscription_user_id',"{{%telegram_subscription}}",
            'user_id', "{{%users}}", 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_subscription}}');
    }
}
