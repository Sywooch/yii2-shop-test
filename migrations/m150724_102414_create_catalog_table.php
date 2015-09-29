<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_102414_create_catalog_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {         
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%category}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL',
                'parent_category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'description' => Schema::TYPE_STRING,
                'keywords' => Schema::TYPE_STRING,
                'content' => Schema::TYPE_STRING,
                'image' => Schema::TYPE_STRING,
                'created' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
                'updated' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
                'active' => Schema::TYPE_INTEGER . ' NOT NULL',
                
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%product}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL',
                'price' => Schema::TYPE_FLOAT,
                'description' => Schema::TYPE_STRING,
                'keywords' => Schema::TYPE_STRING,
                'content' => Schema::TYPE_STRING,
                'image' => Schema::TYPE_STRING,
                'created' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
                'updated' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
                'active' => Schema::TYPE_INTEGER . ' NOT NULL',
                'screen_size' => Schema::TYPE_STRING,
                'os' => Schema::TYPE_STRING,
                'standart' => Schema::TYPE_STRING,
                'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'FOREIGN KEY(category_id) REFERENCES '
                . $this->db->quoteTableName('{{%category}}') . '(id) ON UPDATE CASCADE ON DELETE CASCADE'
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%category}}');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
