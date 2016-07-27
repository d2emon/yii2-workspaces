<?php

use yii\db\Schema;
use yii\db\Migration;

class m160708_071912_job extends Migration
{
    public function safeUp()
    {
	$this->createTable('job', [
	    'id' => Schema::TYPE_PK,
	    'title' => Schema::TYPE_STRING . ' NOT NULL',
	    'image' => 'varchar(6)',
	    'responsibilities' => Schema::TYPE_TEXT,
	]);
        return true;
    }

    public function safeDown()
    {
	$this->dropTable('job');
        return true;
    }
}
