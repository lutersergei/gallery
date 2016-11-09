<?php

use yii\db\Migration;

class m161104_114902_pictures extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pictures}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string()->notNull()->unique(),
            'category_id' => $this->integer()->notNull(),
            'description' => $this->string()->defaultValue(null),
            'views' => $this->integer()->defaultValue(0),
            'rating' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp(),
        ], $tableOptions);

        $this->createIndex('pictures_user', '{{%pictures}}', 'user_id');
        $this->addForeignKey('FK_pictures_user', '{{%pictures}}', 'user_id', '{{%user}}', 'id');

        $this->createIndex('image_category', '{{%pictures}}', 'category_id');
        $this->addForeignKey('FK_image_category', '{{%pictures}}', 'category_id', '{{%category}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_pictures_user', '{{%pictures}}');
        $this->dropForeignKey('FK_pictures_category', '{{%pictures}}');

        $this->dropTable('{{%pictures}}');
    }

}
