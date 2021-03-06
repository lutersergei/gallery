<?php

use yii\db\Migration;

class m161104_114546_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(15)->unique()->notNull(),
        ], $tableOptions);

        $this->execute('INSERT INTO `category` (`id`, `category`) VALUES (\'1\', \'Без категории\')');

    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
