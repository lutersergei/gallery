<?php

use yii\db\Migration;

class m161115_040947_rating extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ratings}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'picture_id' => $this->integer()->notNull(),
            'rating' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
        ], $tableOptions);

        $this->createIndex('rating_user', '{{%ratings}}', 'user_id');
        $this->addForeignKey('FK_rating_user', '{{%ratings}}', 'user_id', '{{%user}}', 'id');

        $this->createIndex('rating_picture', '{{%ratings}}', 'picture_id');
        $this->addForeignKey('FK_rating_picture', '{{%ratings}}', 'picture_id', '{{%pictures}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_rating_user', '{{%ratings}}');
        $this->dropForeignKey('FK_rating_picture', '{{%ratings}}');

        $this->dropTable('{{%ratings}}');
    }

}
