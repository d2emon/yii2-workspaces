<?php

namespace d2emon\workspace;

use Yii;

/**
 * job module definition class
 */
class Module extends \yii\base\Module
{
    public $image_group_name = 'workspace';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'd2emon\workspace\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function getImageGroup()
    {
	return Yii::$app->getModule('image')->getImageGroup($this->image_group_name);
    }
}
