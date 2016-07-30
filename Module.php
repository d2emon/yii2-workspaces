<?php

namespace d2emon\workspace;

use Yii;

/**
 * job module definition class
 */
class Module extends \yii\base\Module
{
    public $image_group_names = ['workspace', 'job'];

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

    public function getImageGroup($group_id=0)
    {
	return Yii::$app->getModule('image')->getImageGroup($this->image_group_names[$group_id]);
    }
}
