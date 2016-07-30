<?php

use yii\helpers\Html;
use yii\grid\GridView;
use d2emon\workspace\components\WorkspaceWidget;
use d2emon\workspace\components\JobWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('job', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('job', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
	    [
	      'attribute' => 'responsibilities',
	      'format' => 'raw',
	      'value' => function($model){
		   return JobWidget::widget(['model' => $model, 'truncate' => 128, 'show_title' => False]);
	      },
	    ],
	    [
	      'attribute' => 'workspace_id',
	      'label' => Yii::t('job', 'Workspace'),
	      'format' => 'raw',
	      'value' => function($model){
		   return WorkspaceWidget::widget(['workspace' => $model->workspace, 'truncate' => 128, 'show_title' => False]);
	      },
	    ],
	    [
	      'attribute' => 'profile_id',
	      'label' => Yii::t('profile', 'Profile'),
	      'format' => 'raw',
	      'value' => function($model){
		   return Html::a($model->profile->fullname, ['/profile', 'id' => $model->profile_id]);
	      },
	    ],
            // 'profile_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
