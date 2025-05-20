<?php

use yii\db\Migration;

class m250520_130807_create_clients_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->char(32)->notNull()->unique(),
            'phone' => $this->char(12)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        $this->createIndex('idx_clients_external_id', '{{%clients}}', 'external_id', true);
    }

    public function safeDown()
    {
        $this->dropIndex('idx_clients_external_id', '{{%clients}}');

        $this->dropTable('{{%clients}}');
    }
}
