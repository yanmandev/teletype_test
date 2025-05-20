<?php

use yii\db\Migration;

class m250520_130849_create_messages_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'dialog_id' => $this->integer()->notNull(),
            'external_id' => $this->char(32)->notNull()->unique(),
            'text' => $this->text()->notNull(),
            'send_at' => $this->integer()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey('fk_messages_client_id', '{{%messages}}', 'client_id', '{{%clients}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_dialogs_dialog_id', '{{%messages}}', 'dialog_id', '{{%dialogs}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx_messages_external_id', '{{%messages}}', 'external_id', true);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_messages_client_id', '{{%messages}}');
        $this->dropForeignKey('fk_dialogs_dialog_id', '{{%messages}}');

        $this->dropIndex('idx_messages_external_id', '{{%messages}}');

        $this->dropTable('{{%messages}}');
    }
}
