<?php

use yii\db\Schema;
use yii\db\Migration;

class m160708_072208_workspace extends Migration
{
    public function safeUp()
    {
	$this->createTable('workspace', [
	    'id' => Schema::TYPE_PK,
	    'title' => Schema::TYPE_STRING . ' NOT NULL',
	    'image' => 'varchar(6)',
	    'description' => Schema::TYPE_TEXT,
	]);
	$this->addColumn('job', 'workspace_id', Schema::TYPE_INTEGER);
	$this->addForeignKey('job_workspace_id', 'job', 'workspace_id', 'workspace', 'id');
        return true;
    }

    public function safeDown()
    {
	$this->dropForeignKey('job_workspace_id', 'job');
	$this->dropColumn('job', 'workspace_id');
	$this->dropTable('workspace');
        return true;
    }
}
