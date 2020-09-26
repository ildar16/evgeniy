<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m200924_070742_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'text' => $this->text(),

            'created_at' => $this->timestamp(), 
            'updated_at' => $this->timestamp(), 
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-messages-user_id',
            'messages',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-user_id',
            'messages',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-user_id',
            'messages'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-messages-user_id',
            'messages'
        );

        $this->dropTable('{{%messages}}');
    }
}
