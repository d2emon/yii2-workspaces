<?php

use yii\helpers\Html;
use yii\grid\GridView;
use uxappetite\yii2image\components\ImagedDescWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('job', 'Workspaces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workspace-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('job', 'Create Workspace'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
	    [
	      'attribute' => 'description',
	      'format' => 'raw',
	      'value' => function($model){
		   return ImagedDescWidget::widget(['model' => $model, 'truncate' => 128]);
	      },
	    ],
	    [
	      'attribute' => 'jobs',
	      'format' => 'raw',
	      'value' => function($model){
		   return count($model->jobs);
	      },
	    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
