<?php
namespace d2emon\workspace\components;

use yii\base\Widget;
use yii\helpers\Html;
use d2emon\workspace\models\Workspace;

class ThumbWidget extends \uxappetite\yii2image\components\ThumbWidget
{
    public $workspace_id;

    public function init()
    {
        parent::init();
        if ($this->workspace_id === null) {
            $this->workspace_id = 0;
        }
	if (!isset($this->options['align'])) {
	    $this->options['align'] = 'left';
	}
    }

    public function run()
    {
	if($this->model === null) {
            $this->model = $this->workspace_id ? Workspace::findOne($this->workspace_id) : null;
	}
	return parent::run();
    }
}

