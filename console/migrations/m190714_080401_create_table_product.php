<?php

use yii\db\Migration;

/**
 * Class m190714_080401_create_table_product
 */
class m190714_080401_create_table_product extends Migration
{
    private $tableName = 'product';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'image' => $this->string()->defaultValue(NULL),
            'views' => $this->integer()->notNull()->defaultValue(0)->unsigned(),
            'active' => $this->boolean()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP'))." ON UPDATE CURRENT_TIMESTAMP",
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190714_080401_init_project cannot be reverted.\n";

        return false;
    }
    */
}
