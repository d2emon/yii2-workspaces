<?php

use yii\db\Schema;
use yii\db\Migration;

class m160708_085132_profile extends Migration
{
    public function safeUp()
    {
	$this->addColumn('job', 'profile_id', Schema::TYPE_INTEGER);
	$this->addForeignKey('job_profile_id', 'job', 'profile_id', 'profile', 'user_id');
        return true;
    }

    public function safeDown()
    {
	$this->dropForeignKey('job_profile_id', 'job');
	$this->dropColumn('job', 'profile_id');
        return true;
    }
}
