<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m200415_100813_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(7)->notNull(),
            'appeared_at' => $this->integer(11)->notNull(),
            'fell_at' => $this->integer(11),
            'eaten' => $this->integer(3)->defaultValue(0),
            'status' => $this->integer(2)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
