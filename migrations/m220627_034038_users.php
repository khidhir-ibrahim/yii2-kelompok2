<?php

use yii\db\Migration;

/**
 * Class m220627_034038_users
 */
class m220627_034038_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('account', [
        'id' => $this->primaryKey(),
        'username' => $this->string(45)->notNull()->unique(),
        'password' => $this->string(250)->notNull(),
        'name' => $this->string(45)->notNull(),
        'role' => $this->string(45)->notNull(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220627_034038_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220627_034038_users cannot be reverted.\n";

        return false;
    }
    */
}
