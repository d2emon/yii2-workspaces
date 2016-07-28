<?php
namespace d2emon\workspace\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use d2emon\workspace\models\Workspace;

class WorkspaceWidget extends Widget
{
    public $workspace;
    public $workspace_id;
    public $image_options;
    public $image_size;
    public $truncate;
    public $show_title;

    public function init()
    {
        parent::init();
        if ($this->workspace_id === null) {
            $this->workspace_id = 0;
        }
	if ($this->image_options === null) {
	    $this->image_options = [
		'align' => 'left',
		'width' => 0,
		'height' => 0,
	    ];
	}
	if ($this->image_size === null) {
	    $this->image_size = 64;
	}
	if ($this->truncate === null) {
	    $this->truncate = 0;
	}
	if ($this->show_title === null) {
	    $this->show_title = True;
	}
    }

    public function run()
    {
	if (!$this->workspace) {
	    return '';
	}

	$options = $this->image_options;
        $options['width']  = $options['width']  ? $options['width']  : $this->image_size;
        $options['height'] = $options['height'] ? $options['height'] : $this->image_size;
	$options['title'] = $this->workspace->image;

	$title  = ($this->show_title && $this->workspace->title) ? Html::a('<h1>'.Html::encode($this->workspace->title)."</h1>\n", ['/workspace/default/view', 'id' => $this->workspace->id]) : '';
	$avatar = ThumbWidget::widget(['model' => $this->workspace, 'suffix' => '_s', 'size' => $this->image_size, 'options' => $options]);
        $desc   = $this->workspace->description;
	if ($this->truncate) {
	    $desc = StringHelper::truncate($desc, 128);
	}	   
	return "<div class=\"advice\">".$title."<div class=\"advice_body\">".$avatar.' '.nl2br($desc)."</div></div>";
    }
}

