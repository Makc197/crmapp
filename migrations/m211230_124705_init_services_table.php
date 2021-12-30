<?php

use yii\db\Migration;

/**
 * Class m211230_124705_init_services_table
 */
class m211230_124705_init_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'service',
            [
                'id' => 'pk',
                'name' => 'string unique',
                'hourly_rate' => 'integer',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211230_124705_init_services_table cannot be reverted.\n";
        $this->dropTable('service');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211230_124705_init_services_table cannot be reverted.\n";

        return false;
    }
    */
}
