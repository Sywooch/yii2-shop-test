<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_123802_change_types_of_fields extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE {{%category}} MODIFY content TEXT NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY content TEXT NOT NULL');
        $this->execute('ALTER TABLE {{%category}} MODIFY created INTEGER NOT NULL');
        $this->execute('ALTER TABLE {{%category}} MODIFY updated INTEGER NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY created INTEGER NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY updated INTEGER NOT NULL');
    }

    public function down()
    {
        $this->execute('ALTER TABLE {{%category}} MODIFY content STRING NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY content STRING NOT NULL');
        $this->execute('ALTER TABLE {{%category}} MODIFY created TIMESTAMP NOT NULL');
        $this->execute('ALTER TABLE {{%category}} MODIFY updated TIMESTAMP NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY created TIMESTAMP NOT NULL');
        $this->execute('ALTER TABLE {{%product}} MODIFY updated TIMESTAMP NOT NULL');
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
