<?php

use yii\db\Migration;

class m250520_130842_create_dialogs_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%dialogs}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_dialogs_client_id', '{{%dialogs}}', 'client_id', '{{%clients}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_dialogs_client_id', '{{%dialogs}}');

        $this->dropTable('{{%dialogs}}');
    }
}
