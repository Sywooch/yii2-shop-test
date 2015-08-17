<?php

use yii\db\Schema;
use yii\db\Migration;

class m150813_095333_add_alias extends Migration
{
    public function up()
    {
        $this->addColumn('{{%category}}', 'alias','VARCHAR(255) NOT NULL');
        $this->addColumn('{{%product}}', 'alias','VARCHAR(255) NOT NULL');
        $this->createIndex('idx_category_alias', '{{%category}}', 'alias');
        $this->createIndex('idx_category_active', '{{%category}}', 'active');
        $this->createIndex('idx_product_alias', '{{%product}}', 'alias');
        $this->createIndex('idx_product_active', '{{%product}}', 'active');
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'alias');
        $this->dropColumn('{{%product}}', 'alias');
        $this->dropIndex('idx_category_alias', '{{%category}}');
        $this->dropIndex('idx_category_active', '{{%category}}');
        $this->dropIndex('idx_product_alias', '{{%product}}');
        $this->dropIndex('idx_product_active', '{{%product}}');
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
