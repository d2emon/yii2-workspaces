<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
// use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use d2emon\workspace\components\WorkspaceWidget;

/* @var $this yii\web\View */
/* @var $model d2emon\workspace\models\Workspace */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('job', 'Workspaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workspace-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('job', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('job', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('job', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
	    [
	      'attribute' => 'description',
	      'format' => 'raw',
              'value' => WorkspaceWidget::widget(['workspace' => $model, 'show_title' => False]),
	    ],
	    [
	      'attribute' => 'jobs',
	      'format' => 'raw',
	      'value' => ListView::widget([
		'dataProvider' => new ArrayDataProvider([
		  'allModels' => $model->jobs,
		]),
		'itemView' => function ($model, $key, $index, $widget) {
		  return Html::a($model->title, ['job/view', 'id' => $model->id]).' - '.
		    Html::a($model->profile->fullname, ['/site/profile', 'id' => $model->profile_id]);
		},
	      ]),
	      /*
	      'value' => GridView::widget([
		'dataProvider' => new ArrayDataProvider([
		  'allModels' => $model->jobs,
		]),
	        'columns' => [
	            'title',
	            ['class' => 'yii\grid\ActionColumn'],
        	],
	      ]),
	       */
	    ],
        ],
    ]) ?>

</div>
