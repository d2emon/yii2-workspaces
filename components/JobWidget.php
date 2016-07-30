<?php
namespace d2emon\workspace\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use d2emon\workspace\models\Workspace;

class JobWidget extends Widget
{
    public $model;
    public $model_id;
    public $image_options;
    public $image_size;
    public $truncate;
    public $show_title;
    public $show_no_image;

    public function init()
    {
        parent::init();
        if ($this->model_id === null) {
            $this->model_id = 0;
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
	if ($this->show_no_image === null) {
	    $this->show_no_image = False;
	}
    }

    public function run()
    {
	if (!$this->model) {
	    return '';
	}

	$options = $this->image_options;
        $options['width']  = $options['width']  ? $options['width']  : $this->image_size;
        $options['height'] = $options['height'] ? $options['height'] : $this->image_size;
	$options['title'] = $this->model->image;

	$title  = ($this->show_title && $this->model->title) ? Html::a('<h1>'.Html::encode($this->model->title)."</h1>\n", ['/workspace/default/view', 'id' => $this->model->id]) : '';
	$avatar = ($this->show_no_image || $this->model->image) ? ThumbWidget::widget(['model' => $this->model, 'suffix' => '_s', 'size' => $this->image_size, 'options' => $options]) : '';
        $desc   = $this->model->description;
	if ($this->truncate) {
	    $desc = StringHelper::truncate($desc, 128);
	}	   
	return "<div class=\"advice\">".$title."<div class=\"advice_body\">".$avatar.' '.nl2br($desc)."</div></div>";
    }
}


