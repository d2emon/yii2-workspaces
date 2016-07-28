<?php

use yii\helpers\Html;
use yii\grid\GridView;
use d2emon\workspace\components\WorkspaceWidget;

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
		   return WorkspaceWidget::widget(['workspace' => $model, 'truncate' => 128, 'show_title' => False]);
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
