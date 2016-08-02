<?php

use yii\helpers\Html;
use yii\grid\GridView;
use uxappetite\yii2image\components\ImagedDescWidget;

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
		   // return JobWidget::widget(['model' => $model, 'truncate' => 128, 'show_title' => False]);
		   return ImagedDescWidget::widget(['model' => $model, 'truncate' => 128]);
	      },
	    ],
	    [
	      'attribute' => 'workspace_id',
	      'label' => Yii::t('job', 'Workspace'),
	      'format' => 'raw',
	      'value' => function($model){
		   return ImagedDescWidget::widget(['model' => $model->workspace, 'truncate' => 128, 'show_title' => True]);
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
